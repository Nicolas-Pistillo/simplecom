<?php

namespace App\Livewire\Forms;

use App\Enums\TaxCondition;
use App\Models\Order;
use Livewire\Attributes\Validate;
use Livewire\Form;

class OrderInvoiceForm extends Form
{
    public $internal_code;
    public $invoice_type;
    public $pay_condition;
    public $sector;
    public $social_reason;
    public $document;
    public $tax_condition;
    public $address;
    public $phone;
    public $email;
    public $send_to_client = true;

    public function autocomplete(Order $order)
    {
        $this->fill([
            'invoice_type'  => 'Factura B',
            'sector'        => tenant()->sector->name,
            'social_reason' => $order->user->full_name,
            'document'      => $order->user->document,
            'tax_condition' => $order->user->tax_condition,
            'address'       => $order->user->invoice_address,
            'phone'         => $order->user->phone,
            'email'         => $order->user->email
        ]);

        if (TaxCondition::needsInvoiceA($this->tax_condition))
        {
            $this->invoice_type  = 'Factura A';
            $this->social_reason = $order->user->invoice_social_reason;
            $this->document      = $order->user->invoice_document;
        }
    }
}
