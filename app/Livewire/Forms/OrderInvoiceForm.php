<?php

namespace App\Livewire\Forms;

use App\Enums\InvoiceItemAliquot;
use App\Enums\InvoicePayCondition;
use App\Enums\InvoiceType;
use App\Enums\TaxCondition;
use App\Models\Order;
use Illuminate\Validation\Rules\Enum;
use Livewire\Attributes\Validate;
use Livewire\Form;

class OrderInvoiceForm extends Form
{
    #[Validate(as: 'cod. interno')]
    public $internal_code;

    #[Validate(as: 'tipo de factura')]
    public $invoice_type;

    #[Validate(as: 'condición de pago')]
    public $pay_condition;

    #[Validate(as: 'rubro')]
    public $sector;

    #[Validate(as: 'razón social')]
    public $social_reason;

    #[Validate(as: 'documento')]
    public $document;

    #[Validate(as: 'condición fiscal')]
    public $tax_condition;

    #[Validate(as: 'domicilio fiscal')]
    public $address;

    #[Validate(as: 'teléfono')]
    public $phone;

    #[Validate(as: 'email')]
    public $email;

    #[Validate(as: 'items')]
    public $items;

    public $send_to_client = true;

    public function rules()
    {
        $rules = [
            'internal_code'  => 'required',
            'invoice_type'   => ['required', new Enum(InvoiceType::class)],
            'pay_condition'  => ['required', new Enum(InvoicePayCondition::class)],
            'sector'         => 'required',
            'social_reason'  => 'required',
            'document'       => 'required|numeric|min:1000000|max:999999999',
            'tax_condition'  => ['required', new Enum(TaxCondition::class)],
            'address'        => 'required',
            'phone'          => 'required|size:10',
            'email'          => 'required|email',
            'send_to_client' => 'required|boolean',
            'items'          => 'required|array|min:1',
            'items.*.code'        => 'required',
            'items.*.description' => 'required',
            'items.*.quantity'    => 'required|numeric|integer',
            'items.*.aliquot'     => ['required', new Enum(InvoiceItemAliquot::class)],
            'items.*.unit_price'  => 'required'
        ];

        if (TaxCondition::needsInvoiceA($this->tax_condition))
        {
            $rules['document'] = 'required|cuit';
        }

        return $rules;
    }

    public function attributes()
    {
        return [
            'items' => 'dale'
        ];
    }

    public function messages()
    {
        return [
            'tax_condition.Illuminate\Validation\Rules\Enum' => 'Seleccione una condición fiscal válida',
            'invoice_type.Illuminate\Validation\Rules\Enum'  => 'Seleccione un tipo de factura válida',
            'pay_condition.Illuminate\Validation\Rules\Enum' => 'Seleccione una condición de pago válida',
            'items.*.aliquot.Illuminate\Validation\Rules\Enum' => 'Seleccione una alicuota válida'
        ];
    }

    public function autocomplete(Order $order)
    {
        $this->fill([
            'invoice_type'  => InvoiceType::InvoiceB->value,
            'pay_condition' => InvoicePayCondition::Cash->value,
            'sector'        => tenant()->sector->name,
            'social_reason' => $order->user->full_name,
            'document'      => $order->user->document,
            'tax_condition' => $order->user->tax_condition->value,
            'address'       => $order->user->invoice_address,
            'items'          => [],
            'phone'         => $order->user->phone,
            'email'         => $order->user->email
        ]);

        if (TaxCondition::needsInvoiceA($this->tax_condition))
        {
            $this->invoice_type  = InvoiceType::InvoiceA->value;
            $this->social_reason = $order->user->invoice_social_reason;
            $this->document      = $order->user->invoice_document;
        }

        foreach($order->items as $item)
        {
            $aliquot = TaxCondition::needsInvoiceA($this->tax_condition)
                        ? InvoiceItemAliquot::IVA21->value
                        : InvoiceItemAliquot::IVA0->value;

            array_push($this->items, [
                'code'         => $item->product_id,
                'description'  => $item->name,
                'quantity'     => $item->quantity,
                'aliquot'      => $aliquot,
                'unit_price'   => $item->unit_price
            ]);
        }
    }
}
