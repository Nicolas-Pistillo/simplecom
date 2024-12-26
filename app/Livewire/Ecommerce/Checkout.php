<?php

namespace App\Livewire\Ecommerce;

use App\Enums\LogisticType;
use App\Livewire\Forms\CheckoutForm;
use App\Services\ShippingProviders\Envia;
use App\Traits\Livewire\WithNotifications;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;
use App\Services\ProductService;
use App\Enums\PaymentRedirectType;
use App\Models\PaymentMethod;
use App\Models\UserAddress;
use App\Services\ShippingProviders\EnvioPack;
use App\Services\ShippingProviders\Zippin;
use App\Utils\ShippingBranch;
use App\Utils\ShippingRate;
use App\Utils\ShippingRateParameters;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class Checkout extends Component
{
    use WithNotifications;

    protected $listeners = [
        'new-address-created'    => 'receiveNewAddress', 
        'selected-dropoff-point' => 'confirmDropoffPoint'
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

            $envia = new Envia();
            $zippin = new Zippin();
            // $envioPack = new EnvioPack();

             $enviaRates = $envia->getRates($shippingParameters);
            // $envioPackRates = $envioPack->getRates($shippingParameters);
             $zippinRates = $zippin->getRates($shippingParameters);

            //$shippingRates = $zippinRates->merge($envioPackRates)->merge($enviaRates);
            $rates = $enviaRates->merge($zippinRates);

            if ($rates->isNotEmpty())
            {
                $shippingRates = $rates->whereIn('logistic_type', [
                                                    LogisticType::DropoffToDoor, 
                                                    LogisticType::OriginToDoor
                                                ]) 
                                                ->sortBy('price')
                                                ->take(4);

                $dropoffRates = $rates->whereIn('logistic_type', [
                                                    LogisticType::DropoffToDropoff, 
                                                    LogisticType::OriginToDropoff
                                                ])
                                                ->sortBy('price');

                session()->put('rates_results', [
                    'address'         => $this->form->selected_address,
                    'shipping_rates'  => $shippingRates,
                    'dropoff_rates'   => $dropoffRates
                ]);

                return $this->form->show_rates_results = true;
            }

            $this->notify([
                'type'  => 'danger',
                'title' => 'Sin tarifas de envío',
                'body'  => 'No se encontraron tarifas de envío para la ubicación seleccionada'
            ]);

        } catch (\Throwable $err) 
        {
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
        $this->form->show_confirmation = true;

        session()->put('selected_rate', $rate);
        session()->put('selected_branch', $branch);
    }

    public function selectAddress(UserAddress $address)
    {
        $this->form->selected_address = $address;

        session()->put('selected_address', $address);

        $this->getShippingRates();
    }

    public function showDropoffSelection()
    {
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
        $this->form->reset('selected_address');
        $this->form->show_rates_results = false;

        session()->remove('rates_results');
    }

    public function changeDropoffPoint()
    {
        $this->form->reset('selected_rate', 'selected_branch');
        $this->form->show_confirmation = false;
        $this->form->show_dropoff_selection = true;
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

        if (!empty(session('rates_results')) && !empty(session('selected_rate')))
        {
            $this->form->selected_rate = session('selected_rate');
            $this->form->selected_branch = session('selected_branch');
            
            $this->form->show_confirmation = true;
            return $this->current_step = 2;
        }

        if (Auth::check())
        {
            Auth::user()->update([
                'name'     => $data['name'],
                'lastname' => $data['lastname'],
                'phone'    => $data['phone'],
                'document' => $data['document']
            ]);
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
            $paymentMethod = PaymentMethod::find($this->form->selected_payment_method);

            $service = $paymentMethod->service();
    
            if ($service->redirect_type === PaymentRedirectType::None)
            {
                dd("termina aca el checkout");
            }

            if ($service->redirect_type === PaymentRedirectType::FrontendCheckout)
                $this->dispatch("$paymentMethod->code-checkout", $service->frontend_init_data);

            $service->generateCheckout(['id' => 123]);

            if ($service->redirect_type === PaymentRedirectType::ProviderPlatform)
                $this->redirect($service->provider_checkout_url);

        } catch (\Throwable $th) 
        {
            $this->notify([
                'type'  => 'danger',
                'title' => 'Error al crear el pedido',
                'body'  => 'Por favor, vuelva a intentarlo más tarde'
            ]);

            Log::error("Error al generar un pedido", [
                'tenant'            => tenant('name'),
                'payment_method'    => $paymentMethod->code,
                'exception_message' =>  $th->getMessage()
            ]);
        }
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
        $this->form->payment_methods = PaymentMethod::where('active', true)->get();

        $this->form->autocomplete();

        if ($this->form->hasCustomerData()) $this->shippingStep();
    }

    public function render()
    {
        return view('livewire.ecommerce.checkout');
    }
}