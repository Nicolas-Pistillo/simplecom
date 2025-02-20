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
    public $order_id;

    #[Validate(as: 'tipo de factura')]
    public $invoice_type;

    #[Validate(as: 'tipo de proceso')]
    public $invoice_queued = false;

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

    #[Validate(as: 'bonificación general')]
    public $bonification;

    #[Validate(as: 'teléfono')]
    public $phone;

    #[Validate(as: 'email')]
    public $email;

    #[Validate(as: 'items')]
    public $items;

    public $send_to_client = true;

    public $subtotal;
    public $total_iva;
    public $discounts;
    public $total;

    public function rules()
    {
        $rules = [
            'invoice_type'   => ['required', new Enum(InvoiceType::class)],
            'invoice_queued' => 'required|boolean',
            'pay_condition'  => ['required', new Enum(InvoicePayCondition::class)],
            'sector'         => 'required',
            'social_reason'  => 'required',
            'document'       => 'required|numeric|min:1000000|max:999999999',
            'tax_condition'  => ['required', new Enum(TaxCondition::class)],
            'address'        => 'required',
            'phone'          => 'required|size:10',
            'email'          => 'required|email',
            'send_to_client' => 'required|boolean',
            'bonification'   => 'required|numeric|integer|min:0',
            'items'          => 'required|array|min:1',
            'items.*.code'        => 'required',
            'items.*.description' => 'required',
            'items.*.quantity'    => 'required|numeric|integer',
            'items.*.aliquot'     => ['required', new Enum(InvoiceItemAliquot::class)],
            'items.*.unit_price'  => 'required',
            'items.*.discount'    => 'required|numeric|integer|min:0|max:100'
        ];

        if (TaxCondition::needsInvoiceA($this->tax_condition))
        {
            $rules['document'] = 'required|cuit';
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'tax_condition.Illuminate\Validation\Rules\Enum' => 'Seleccione una condición fiscal válida',
            'invoice_type.Illuminate\Validation\Rules\Enum'  => 'Seleccione un tipo de factura válida',
            'pay_condition.Illuminate\Validation\Rules\Enum' => 'Seleccione una condición de pago válida',
            'items.*.aliquot.Illuminate\Validation\Rules\Enum' => 'Seleccione una alicuota válida',
            'bonification.required'         => 'La bonificación mínima debe ser 0',
            'items.required'                => 'Debes agregar al menos un concepto a facturar',
            'items.*.code.required'         => 'El código es obligatorio',
            'items.*.description.required'  => 'La descripción es obligatoria',
            'items.*.quantity.required'     => 'La cantidad es obligatoria',
            'items.*.quantity.numeric'      => 'La cantidad debe ser un número',
            'items.*.quantity.integer'      => 'La cantidad debe ser un número entero',
            'items.*.unit_price'            => 'El precio unitario es obligatorio',
            'items.*.discount.required'     => 'El descuento mínimo debe ser 0',
            'items.*.discount.min'          => 'El descuento mínimo debe ser 0',
            'items.*.discount.max'          => 'El descuento máximo es 100%',
            'items.*.discount.numeric'      => 'El descuento debe ser un número',
            'items.*.discount.integer'      => 'El descuento debe ser un número entero',
        ];
    }

    public function autocomplete(Order $order)
    {
        $this->fill([
            'order_id'      => $order->id,
            'invoice_type'  => InvoiceType::InvoiceB->value,
            'pay_condition' => InvoicePayCondition::Cash->value,
            'sector'        => tenant()->sector->name,
            'bonification'  => 0,
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
                        ? InvoiceItemAliquot::IVA21
                        : InvoiceItemAliquot::IVA0;

            $unit_price = $aliquot === InvoiceItemAliquot::IVA21
                                       ? round($item->unit_price / 1.21, 2)
                                       : floatval($item->unit_price);

            array_push($this->items, [
                'code'          => $item->product_id,
                'description'   => $item->name,
                'quantity'      => $item->quantity,
                'aliquot'       => $aliquot->value,
                'initial_price' => floatval($item->unit_price),
                'unit_price'    => $unit_price,
                'discount'      => $item->discount ?? 0
            ]);
        }

        if ($order->shipping_cost > 0)
        {
            $aliquot = TaxCondition::needsInvoiceA($this->tax_condition)
                        ? InvoiceItemAliquot::IVA21
                        : InvoiceItemAliquot::IVA0;

            $unit_price = $aliquot === InvoiceItemAliquot::IVA21
                                       ? round($order->shipping_cost / 1.21, 2)
                                       : floatval($order->shipping_cost);

            array_push($this->items, [
                'code'          => "envio",
                'description'   => $order->shipping->provider_label,
                'quantity'      => 1,
                'aliquot'       => $aliquot->value,
                'initial_price' => floatval($order->shipping_cost),
                'unit_price'    => $unit_price,
                'discount'      => 0
            ]);
        }
    }

    public function recalculatePricing()
    {
        foreach($this->items as $index => $item)
        {
            $aliquotValue = InvoiceItemAliquot::tryFrom($item['aliquot'])->numberValue();

            if (!$item['initial_price']) $item['initial_price'] = $item['unit_price'];

            if ($aliquotValue == 0)
            {
                $this->items[$index]['unit_price'] = $item['initial_price'];
            }

            if ($aliquotValue > 0)
            {
                $this->items[$index]['unit_price'] = round($item['initial_price'] / $aliquotValue, 2);
            }
        }
    }
}
