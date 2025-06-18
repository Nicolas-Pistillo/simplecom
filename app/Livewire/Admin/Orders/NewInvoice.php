<?php

namespace App\Livewire\Admin\Orders;

use App\Enums\InvoiceItemAliquot;
use App\Enums\InvoiceType;
use App\Enums\TaxCondition;
use App\Livewire\Forms\OrderInvoiceForm;
use App\Models\Order;
use App\Services\InvoiceProviders\TusFacturas;
use App\Traits\Livewire\WithNotifications;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Computed;
use Livewire\Component;

class NewInvoice extends Component
{
    use WithNotifications;

    public Order $order;
    public OrderInvoiceForm $form;

    #[Computed]
    public function subtotal()
    {
        try 
        {
            return collect($this->form->items)->sum(function($item) 
            {
                $itemPrice = $item['unit_price'] * $item['quantity'];
                
                return $itemPrice;
            });
        } catch (\Throwable $th) {}
    }

    #[Computed]
    public function total_iva()
    {
        try 
        {
            return collect($this->form->items)->sum(function($item) 
            {
                if (!$item['initial_price']) $item['initial_price'] = $item['unit_price'];

                $totalUnitary = $item['unit_price'] * $item['quantity'];
                $totalInitial = $item['initial_price'] * $item['quantity'];

                if ($item['discount'] > 0) 
                {
                    $totalUnitary -= $totalUnitary * ($item['discount'] / 100);
                    $totalInitial -= $totalInitial * ($item['discount'] / 100);
                }

                return $totalInitial - $totalUnitary;
            });
        } catch (\Throwable $th) {}
    }

    #[Computed]
    public function discounts()
    {
        try 
        {
            return collect($this->form->items)->sum(function($item) 
            {
                $itemPrice = $item['unit_price'] * $item['quantity'];

                if ($item['discount'] > 0) 
                {
                    return $itemPrice * ($item['discount'] / 100);
                }

                return 0;
            });
        } catch (\Throwable $th) {};
    }

    #[Computed]
    public function total()
    {
        try {
            return $this->subtotal - $this->discounts + $this->totalIva - $this->form->bonification;
        } catch (\Throwable $th) {}
    }

    public function updatedForm($value, $property)
    {
        if ($property === 'invoice_type')
        {
            $newAliquot = InvoiceType::tryFrom($value)->determinesIVA()
                            ? InvoiceItemAliquot::IVA21
                            : InvoiceItemAliquot::IVA0;

            foreach($this->form->items as $index => $item)
            {
                $this->form->items[$index]['aliquot'] = $newAliquot->value;
            }

            $this->form->recalculatePricing();
        }

        if ($property === 'tax_condition')
        {
            $newAliquot = TaxCondition::needsInvoiceA($value)
                            ? InvoiceItemAliquot::IVA21
                            : InvoiceItemAliquot::IVA0;

            foreach($this->form->items as $index => $item)
            {
                $this->form->items[$index]['aliquot'] = $newAliquot->value;
            }

            $this->form->recalculatePricing();
        }

        if (str_ends_with($property, '.aliquot'))
        {
            $this->form->recalculatePricing();
        }
    }

    public function addItem()
    {
        $aliquot = TaxCondition::needsInvoiceA($this->form->tax_condition)
                    ? InvoiceItemAliquot::IVA21->value
                    : InvoiceItemAliquot::IVA0->value;

        array_push($this->form->items, [
            'code'          => null,
            'description'   => null,
            'quantity'      => 1,
            'aliquot'       => $aliquot,
            'initial_price' => null,
            'unit_price'    => null,
            'discount'      => 0
        ]);
    }

    public function removeItem($index)
    {
        unset($this->form->items[$index]);
        $this->form->items = array_values($this->form->items);
    }

    public function save()
    {
        $this->form->validate();

        try 
        {
            $this->form->fill([
                'subtotal'  => $this->subtotal,
                'total_iva' => $this->total_iva,
                'discounts' => $this->discounts,
                'total'     => $this->total,
            ]);

            $provider = new TusFacturas();

            $serviceResponse = $provider->createOrderInvoice($this->form);

            if (isset($serviceResponse['errors']))
            {
                foreach($serviceResponse['errors'] as $error)
                {
                    $this->addError('service_errors', $error);
                }

                $this->dispatch('service-errors-received');

                return;
            }

            $this->dispatch('order-invoice-created');

            $this->dispatch('close-order-invoice-form');

            $this->notify([
                'type'  => 'success',
                'title' => $this->form->invoice_queued ? 'Factura en proceso' : 'Factura emitida',
                'body'  => $this->form->invoice_queued ? 'La factura se emitira en breve' : 'Facturaste este pedido correctamente'
            ]);

        } catch (\Throwable $th) 
        {
            $this->notify([
                'type'  => 'danger',
                'title' => 'Ocurrió un error inesperado al facturar',
                'body'  => 'Por favor vuelva a intentarlo más tarde o contáctese con soporte'
            ]);

            Log::channel('error')->error('Error al facturar pedido', [
                'tenant'  => tenant('name'),
                'pedido'  => $this->order->id,
                'message' => $th->getMessage()
            ]);
        }
    }

    public function mount(Order $order)
    {
        $this->order = $order;
        $this->form->autocomplete($order);
    }

    public function render()
    {
        return view('livewire.admin.orders.new-invoice');
    }
}
