<?php

namespace App\Livewire\Ecommerce;

use App\Enums\DeliveryType;
use App\Enums\OrderFeedEvent;
use App\Enums\OrderFeedPresentation;
use App\Enums\OrderStatus;
use App\Livewire\Forms\CheckoutForm;
use App\Traits\Livewire\WithNotifications;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;
use App\Services\ProductService;
use App\Enums\PaymentRedirectType;
use App\Enums\PaymentStatus;
use App\Enums\TaxCondition;
use App\Models\Order;
use App\Models\PaymentMethod;
use App\Models\UserAddress;
use App\Services\OrderService;
use App\Services\ShippingRateService;
use App\Utils\ShippingRateParameters;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class Checkout extends Component
{
    use WithNotifications;

    protected $listeners = [
        'new-address-created'      => 'receiveNewAddress', 
        'selected-dropoff-point'   => 'confirmDropoffPoint',
        'cancel-frontend-checkout' => 'cancelFrontendCheckout'
    ];

    public CheckoutForm $form;

    public $current_step = 1;

    public function getShippingRates()
    {
        try 
        {
            if (session('rates_results') 
            && session('rates_results.address.id') === $this->form->selected_address->id)
            {
                return $this->form->show_rates_results = true;
            }

            $shippingParameters = new ShippingRateParameters([
                'recipient_name'     => "{$this->form->name} {$this->form->lastname}",
                'recipient_email'    => $this->form->email,
                'recipient_phone'    => $this->form->phone,
                'recipient_document' => $this->form->document,
                'recipient_address'  => $this->form->selected_address
            ]);

            $rates = ShippingRateService::get($shippingParameters);

            if ($rates->isEmpty())
            {
                $this->form->reset('selected_address');
                session()->remove('selected_address');

                return $this->notify([
                    'type'  => 'danger',
                    'title' => 'Sin tarifas de envío',
                    'body'  => 'No se encontraron tarifas de envío para la ubicación seleccionada'
                ]);
            }

            session()->put('rates_results', [
                'address'         => $this->form->selected_address,
                'shipping_rates'  => $rates->get('shipping'),
                'dropoff_rates'   => $rates->get('dropoff')
            ]);

            return $this->form->show_rates_results = true;

        } catch (\Throwable $err) 
        {
            $this->form->reset('show_rates_results', 'selected_address');

            Log::channel('error')->error('Error al cotizar envío', [
                'tenant'        => tenant('name'),
                'message'       => $err->getMessage(),
                'address_rated' => $this->form->selected_address
            ]);

            $this->notify([
                'type'  => 'danger',
                'title' => 'Error al cotizar envío',
                'body'  => 'Ocurrió un problema al solicitar las tarifas, por favor vuelva a intentarlo más tarde o eliga otra forma de entrega'
            ]);
        }
    }

    public function receiveNewAddress(UserAddress $address)
    {
        $this->form->addresses->push($address);
    }

    public function confirmDropoffPoint($rate, $branch)
    {
        $this->form->selected_rate = $rate;
        $this->form->selected_branch = $branch;

        $this->form->show_rates_results = false;
        $this->form->show_dropoff_selection = false;
        $this->form->show_selected_branch = true;

        session()->put('selected_rate', $rate);
        session()->put('selected_branch', $branch);
    }

    public function selectAddress(UserAddress $address)
    {
        $this->form->selected_address = $address;

        session()->put('selected_address', $address);

        $this->getShippingRates();
    }

    public function selectShippingRate($rateKey)
    {
        $rate = session('rates_results.shipping_rates')->where('key', $rateKey)->first();

        $rate = collect($rate)->except('branches')->toArray();

        $this->form->selected_rate = $rate;

        session()->put('selected_rate', $rate);
    }

    public function showDropoffSelection()
    {
        $this->form->reset('selected_rate', 'selected_branch');
        session()->forget(['selected_rate', 'selected_branch']);

        $this->form->show_rates_results = false;
        $this->form->show_dropoff_selection = true;
    }

    public function hideDropoffSelection()
    {
        $this->form->show_rates_results = true;
        $this->form->show_dropoff_selection = false;
    }

    public function changeAddress()
    {
        $this->form->reset('selected_address', 'selected_rate', 'selected_branch');
        $this->form->show_rates_results = false;

        session()->forget([
            'rates_results', 'selected_address', 'selected_rate', 'selected_branch'
        ]);
    }

    public function changeDropoffPoint()
    {
        $this->form->reset('selected_rate', 'selected_branch');
        session()->forget(['selected_rate', 'selected_branch']);

        $this->form->show_selected_branch = false;
        $this->form->show_dropoff_selection = true;
    }

    public function changeShippingRate()
    {
        $this->form->reset('selected_rate', 'selected_branch');
        session()->forget(['selected_rate', 'selected_branch']);

        $this->form->show_selected_branch = false;
        $this->form->show_dropoff_selection = false;
        $this->form->show_rates_results = true;
    }

    public function changeQty($operation, $rowId)
    {
        $cartItem = Cart::get($rowId);
        $actualQty = $cartItem->qty;
        $variantId = $cartItem->options->variant_id;

        if ($actualQty === 1 && $operation === 'subtract') return;

        $newQty = $operation === 'subtract' ? $actualQty - 1 : $actualQty + 1;

        ProductService::validateProductSelection($newQty, $cartItem->model, [
            'variant_id'      => $variantId,
            'validator_label' => "product-$rowId-selection"
        ]);

        Cart::update($rowId, ['qty' => $newQty]);

        $this->notify([
            'type'      => 'success',
            'title'     => 'Carrito actualizado',
            'position'  => 'bottom-right'
        ]);
    }

    public function removeItem($rowId)
    {
        Cart::remove($rowId);
        
        if (Cart::count() > 0)
        {
            $this->notify([
                'type'      => 'success',
                'title'     => 'Carrito actualizado',
                'position'  => 'bottom-right'
            ]);
        }
    }

    public function shippingStep()
    {
        $data = $this->form->validateCustomerData();

        if (Auth::check())
        {
            Auth::user()->update([
                'name'                  => $data['name'],
                'lastname'              => $data['lastname'],
                'phone'                 => $data['phone'],
                'document'              => $data['document'],
                'tax_condition'         => $data['tax_condition'],
                'invoice_address'       => $data['invoice_address'] ?? Auth::user()->invoice_address,
                'invoice_social_reason' => $data['invoice_social_reason'] ?? Auth::user()->invoice_social_reason,
                'invoice_document'      => $data['invoice_document'] ?? Auth::user()->invoice_document
            ]);
        }

        if (!empty(session('rates_results')) && !empty(session('selected_branch')))
        {
            $this->form->selected_rate = session('selected_rate');
            $this->form->selected_branch = session('selected_branch');
            
            $this->form->show_selected_branch = true;
            return $this->current_step = 2;
        }

        $lastAddress = session('selected_address');

        if ($lastAddress instanceof UserAddress && 
        $this->form->addresses->contains('id', $lastAddress->id))
        {
            $this->form->selected_address = $lastAddress;
            $this->getShippingRates();
        }

        $this->current_step = 2;
    }

    public function setStep($step)
    {
        $this->current_step = $step;
    }

    public function confirmOrder()
    {
        try 
        {
            if (empty(Cart::content()))
            {
                throw new Exception('Intento de compra con el carrito vacío');
            }

            $order = OrderService::createFromCheckout($this->form);

            $paymentMethod = PaymentMethod::find($this->form->selected_payment_method);

            $service = $paymentMethod->service();

            if ($service->redirect_type === PaymentRedirectType::FrontendCheckout)
            {
                return $this->dispatch("$paymentMethod->code-checkout", [
                    'order'         => $order,
                    'intention_url' => route("$paymentMethod->code.payment-intention", $order->id)
                ]);
            }

            $service->generateCheckout($order);
    
            if ($service->redirect_type === PaymentRedirectType::None)
            {
                $this->redirect($order->paymentReturn());
            }

            if ($service->redirect_type === PaymentRedirectType::ProviderPlatform)
            {
                $this->redirect($service->provider_checkout_url);
            }

        } catch (\Throwable $th)
        {
            $this->notify([
                'type'  => 'danger',
                'title' => 'Error al crear el pedido',
                'body'  => 'Por favor, vuelva a intentarlo más tarde'
            ]);

            Log::channel('error')->error("Error al generar pedido", [
                'tenant'            => tenant('name'),
                'exception_message' => $th->getMessage(),
                'checkout_form'     => $this->form->all()
            ]);
        }
    }

    public function cancelFrontendCheckout(Order $order)
    {
        $order->update(['status' => OrderStatus::PaymentCancelled]);
        $order->payment->update(['status' => PaymentStatus::CustomerCancelled]);

        $order->feed()->create([
            'event'         => OrderFeedEvent::PaymentUpdate,
            'presentation'  => OrderFeedPresentation::Icon,
            'initializator' => $order->user->full_name,
            'action'        => 'canceló el proceso de pago del pedido',
            'meta'          => [
                'icon_code'  => 'credit_card_off',
                'icon_color' => 'red'
            ]
        ]);
    }

    public function updatedForm($value, $key)
    {
        if ($key === 'delivery_type')
        {
            session()->put('delivery_type', $value);

        } else 
        {
            if (Auth::guest()) session()->put("guest_customer.$key", $value);
        }
    }

    public function mount()
    {   
        $this->form->autocomplete();

        if ($this->form->hasCustomerData()) $this->shippingStep();
    }

    public function render()
    {
        if ($this->form->selected_rate && $this->form->delivery_type === DeliveryType::Shipping)
        {
            Cart::addCost('shipping', $this->form->selected_rate['price']);
        }

        return view('livewire.ecommerce.checkout');
    }
}