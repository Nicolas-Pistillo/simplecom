<?php

namespace App\Livewire\Admin\Orders;

use App\Enums\InvoiceItemAliquot;
use App\Enums\TaxCondition;
use App\Livewire\Forms\OrderInvoiceForm;
use App\Models\Order;
use App\Services\InvoiceProviders\TusFacturas;
use Livewire\Attributes\Computed;
use Livewire\Component;

class NewInvoice extends Component
{
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

                if ($item['discount'] > 0) 
                {
                    $itemPrice -= $itemPrice * ($item['discount'] / 100);
                }
                
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
                $itemPrice = $item['unit_price'] * $item['quantity'];

                if ($item['discount'] > 0) 
                {
                    $itemPrice -= $itemPrice * ($item['discount'] / 100);
                }

                $aliquot = InvoiceItemAliquot::tryFrom($item['aliquot'])->numberValue();

                if ($aliquot <= 0) return 0;

                return $aliquot * $itemPrice / 100;
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
            return ($this->subtotal + $this->totalIva) - $this->form->bonification;
        } catch (\Throwable $th) {}
    }

    public function addItem()
    {
        $aliquot = TaxCondition::needsInvoiceA($this->form->tax_condition)
                    ? InvoiceItemAliquot::IVA21->value
                    : InvoiceItemAliquot::IVA0->value;

        array_push($this->form->items, [
            'code'         => null,
            'description'  => null,
            'quantity'     => null,
            'aliquot'      => $aliquot,
            'unit_price'   => null,
            'discount'     => 0
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

            $provider->createOrderInvoice($this->form);

        } catch (\Throwable $th) 
        {
            dd($th->getMessage());
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
