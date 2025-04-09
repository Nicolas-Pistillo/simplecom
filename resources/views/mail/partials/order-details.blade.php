<table style="width: 100%" cellpadding="0" cellspacing="0" role="none">
    <tr>
        <td>
            <p style="margin: 0">
                <b style="font-size: 24px">Pedido {{ $order->id }}</b>
            </p> 
        </td>
        <td style="text-align: right">
            <a href="{{ $order->customerDetailPage() }}" class="btn-md">
                Ver en mis pedidos
            </a>
        </td>
    </tr>
</table>

<div role="separator" style="line-height: 31px;">&zwj;</div>

@foreach ($order->items as $item)
    <table style="width: 100%" cellpadding="0" cellspacing="0" role="none">
        <tr>
            <td style="width: 72px; vertical-align: top">
                <img src="{{ $item->product->first_image }}" alt="{{ $item->name }}" width="48"
                    style="max-width: 100%; vertical-align: middle; border-radius: 8px">
            </td>

            <td class="sm-w-auto"
                style="width: 400px; text-align: left; vertical-align: top; padding: 4px;
                font-size: 16px; color: #111827">

                <p style="margin: 0 0 8px; line-height: 16px; font-weight: 700">
                    {{ $item->name }}
                </p>

                <p style="margin: 0; line-height: 12px; color: #6b7280; font-size: 14px">
                    Cantidad: {{ $item->quantity }}
                </p>

                @if ($item->variant && isset($item->variant->options))
                    @foreach ($item->variant->options as $variantOption)
                        <p style="margin: 8px 0 0; line-height: 22px; color: #6b7280; font-size: 14px">
                            {{ $variantOption->attribute->name }}:
                            {{ $variantOption->attributeValue->name }}
                        </p>
                    @endforeach
                @endif
                {{-- <p style="margin: 8px 0 0; line-height: 22px; color: #6b7280">
                        PROMO20 (-$20)
                    </p> --}}
            </td>
            <td style="width: 88px; text-align: right; vertical-align: top; font-size: 16px; line-height: 22px">
                @if ($item->sell_price < $item->unit_price)
                    <p style="margin: 0; margin-top: -16px; color: #6b7280; font-size: 12px">
                        <del>${{ $item->unit_price }}</del>
                    </p>
                @endif
                <p style="margin: 0; min-width: 120px; font-weight: 700; color: #111827">
                    ${{ priceFormat($item->sell_price) }}
                </p>
            </td>
        </tr>
    </table>

    <div role="separator" style="line-height: 31px;">&zwj;</div>
@endforeach

<div role="separator" style="height: 2px; line-height: 2px;"></div>

<div align="right" class="sm-text-left">
    <table class="sm-w-full" cellpadding="0" cellspacing="0" role="none">
        <tr>
            <td style="font-size: 14px; line-height: 16px; font-weight: 600; color: #6b7280">
                Subtotal
            </td>
            <td style="width: 200px; text-align: right; font-size: 21px; line-height: 28px; color: #111827">
                ${{ priceFormat($order->subtotal) }}
            </td>
        </tr>
        <tr role="separator">
            <td colspan="2" style="line-height: 12px">&zwj;</td>
        </tr>
        @if ($order->shipping)
            <tr>
                <td style="font-size: 14px; line-height: 16px; font-weight: 600; color: #6b7280">
                    Envío
                </td>
                <td style="width: 200px; text-align: right; font-size: 21px; line-height: 28px; color: #111827">
                    ${{ priceFormat($order->shipping_cost) }}
                </td>
            </tr>
        @endif
        <tr role="separator">
            <td colspan="2" style="line-height: 12px">&zwj;</td>
        </tr>
        <tr>
            <td style="font-size: 14px; font-weight: 600; line-height: 16px; color: #6b7280">
                Total
            </td>
            <td
                style="width: 200px; text-align: right; font-size: 21px; line-height: 28px; font-weight: 700; color: #111827">
                ${{ priceFormat($order->total) }}
            </td>
        </tr>
        <tr role="separator">
            <td colspan="2" style="line-height: 12px">&zwj;</td>
        </tr>
        <tr role="separator">
            <td colspan="2" style="line-height: 12px">&zwj;</td>
        </tr>
    </table>
</div>

<div role="separator" style="line-height: 32px;">&zwj;</div>

<table style="width: 100%" cellpadding="0" cellspacing="0" role="none">
    <tr>
        <td>
            <table style="width: 100%" cellpadding="0" cellspacing="0" role="none">
                <tr>
                    <td class="sm-inline-block sm-w-full sm-px-0"
                        style="width: 50%; padding: 0 8px 32px 0; vertical-align: top">
                        <h4 style="margin: 0 0 8px; font-size: 16px; line-height: 22px; color: #6b7280">
                            Cliente
                        </h4>
                        <p style="margin: 0; font-size: 14px; line-height: 22px; color: #6b7280">
                            {{ $order->user->full_name }}
                            <br>
                            {{ $order->user->email }}
                            <br>
                            {{ $order->user->document }}
                            <br>
                            {{ $order->user->phone }}
                        </p>
                    </td>
                    <td class="sm-inline-block sm-w-full sm-px-0"
                        style="width: 50%; padding: 0 0 32px 8px; vertical-align: top">
                        <h4 style="margin: 0 0 8px; font-size: 16px; line-height: 22px; color: #6b7280">
                            Datos de facturación
                        </h4>
                        <p style="margin: 0; font-size: 14px; line-height: 22px; color: #6b7280">
                            {{ $order->user->invoice_social_reason ?? $order->user->full_name }}
                            <br>
                            {{ $order->user->tax_condition->name() }}
                            <br>
                            @if (TaxCondition::needsInvoiceA(!empty($order->user->tax_condition) ? $order->user->tax_condition : null))
                                {{ $order->user->invoice_document }}
                            @else
                                {{ $order->user->document }}
                            @endif
                            <br>
                            {{ $order->user->invoice_address }}
                        </p>
                    </td>
                </tr>
                <tr>
                    @if ($order->shipping)
                        <td class="sm-inline-block sm-w-full sm-px-0"
                            style="width: 50%; padding: 0 8px 32px 0; vertical-align: top">
                            @if ($order->shipping->logistic_type->isToDropoff())
                                @php
                                    $branch = $order->shipping->selected_branch;
                                    $branch_coordinates = data_get($branch, 'address.coordinates');

                                    if (!empty($branch_coordinates['lat'] && !empty($branch_coordinates['lng']))) {
                                        $branch_map = "https://maps.google.com/?q={$branch_coordinates['lat']},{$branch_coordinates['lng']}";
                                    }

                                @endphp
                                <h4 style="margin: 0 0 8px; font-size: 16px; line-height: 22px; color: #6b7280">
                                    Envío a sucursal
                                </h4>
                                <p style="margin: 0; font-size: 14px; line-height: 22px; color: #6b7280">
                                    Retiraras tu pedido en sucursal
                                    <a href="{{ $branch_map ?? '#' }}">{{ data_get($branch, 'name') }}</a>

                                    @if (!empty($order->shipping->delivery_estimate))
                                        <br>
                                        Estimado: {{ $order->shipping->delivery_estimate }}
                                    @endif
                                </p>
                            @else
                                <h4 style="margin: 0 0 8px; font-size: 16px; line-height: 22px; color: #6b7280">
                                    Método de envío
                                </h4>
                                <p style="margin: 0; font-size: 14px; line-height: 22px; color: #6b7280">
                                    {{ $order->shipping->provider_label }}
                                    @if (!empty($order->shipping->delivery_estimate))
                                        <br>
                                        Estimado: {{ $order->shipping->delivery_estimate }}
                                    @endif
                                </p>
                            @endif
                        </td>
                    @endif

                    @if ($order->storePickup)
                        <td class="sm-inline-block sm-w-full sm-px-0"
                            style="width: 50%; padding: 0 8px 32px 0; vertical-align: top">
                            <h4 style="margin: 0 0 8px; font-size: 16px; line-height: 22px; color: #6b7280">
                                Retiro en tienda
                            </h4>
                            <p style="margin: 0; font-size: 14px; line-height: 22px; color: #6b7280">
                                Retirarás tu pedido en
                                <a
                                    href="{{ !empty($order->storePickup->map_url) ? $order->storePickup->map_url : '#' }}">
                                    {{ $order->storePickup->name }}
                                </a>
                            </p>
                        </td>
                    @endif

                    <td class="sm-inline-block sm-w-full sm-px-0"
                        style="width: 50%; padding: 0 0 32px 8px; vertical-align: top">
                        <h4 style="margin: 0 0 8px; font-size: 16px; line-height: 22px; color: #6b7280">
                            Método de pago
                        </h4>
                        <table cellpadding="0" cellspacing="0" role="none">
                            <tr>
                                <td>
                                    <img src="{{ Storage::url("providers/{$order->paymentMethod->code}.png") }}"
                                        alt="VISA" width="40" style="max-width: 100%; vertical-align: bottom">
                                </td>
                                <td style="padding-left: 8px">
                                    <p style="margin: 0; font-size: 14px; line-height: 22px; color: #6b7280">
                                        {{ $order->paymentMethod->display_name }}
                                    </p>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>

@if ($order->storePickup)
    <table style="width: 100%" cellpadding="0" cellspacing="0" role="none">
        <tr>
            <td>
                <h2
                    style="margin: 0 0 8px; white-space: nowrap; font-size: 21px; line-height: 30px; font-weight: 600; color: #111827">
                    Información para retirar
                </h2>
            </td>
        </tr>
        <tr>
            <td>Dirección</td>
            <td style="padding-bottom: 4px; min-width: 230px; text-align:right">
                {{ $order->storePickup->address }}
            </td>
        </tr>

        <tr>
            <td>Horarios</td>
            <td style="padding-bottom: 4px; min-width: 230px; text-align:right">
                {{ $order->storePickup->schedule }}
            </td>
        </tr>

        @if (!empty($order->storePickup->observations))
            <tr>
                <td>Detalle</td>
                <td style="padding-bottom: 4px; min-width: 230px; text-align:right">
                    {{ $order->storePickup->observations }}
                </td>
            </tr>
        @endif
    </table>

    <p style="font-size: 12px;color: #6b7280; margin-top: 24px; font-weight: 600">
        Serás notificado una vez que tu pedido esté listo para pasar a retirar, mientras tanto podes seguir
        su estado <a href="{{ $order->customerDetailPage() }}">desde aquí</a>
    </p>
@endif

<div role="separator" style="line-height: 31px;">&zwj;</div>

@if ($order->paymentMethod->code === 'transfer')
    <table style="width: 100%" cellpadding="0" cellspacing="0" role="none">
        <tr>
            <td>
                <h2 style="margin: 0 0 8px; font-size: 21px; line-height: 30px; font-weight: 600; color: #111827">
                    Datos para transferir
                </h2>
            </td>
        </tr>
        @if (!empty(($bankName = tenant()->configValue('transfer_bank'))))
            <tr>
                <td>Banco</td>
                <td style="padding-bottom: 4px; min-width: 230px; text-align:right">
                    {{ $bankName }}
                </td>
            </tr>
        @endif

        @if (!empty(($bankAccountOwner = tenant()->configValue('transfer_account_owner'))))
            <tr>
                <td>Titular</td>
                <td style="padding-bottom: 4px; min-width: 230px; text-align:right">
                    {{ $bankAccountOwner }}
                </td>
            </tr>
        @endif

        @if (!empty(($bankAlias = tenant()->configValue('transfer_alias'))))
            <tr>
                <td>Alias</td>
                <td style="padding-bottom: 4px; min-width: 230px; text-align:right">
                    {{ $bankAlias }}
                </td>
            </tr>
        @endif

        @if (!empty(($bankCBU = tenant()->configValue('transfer_cbu'))))
            <tr>
                <td>CBU</td>
                <td style="padding-bottom: 4px; min-width: 230px; text-align:right">
                    {{ $bankCBU }}
                </td>
            </tr>
        @endif

        <tr>
            <td>Monto</td>
            <td style="padding-bottom: 4px; min-width: 230px; text-align:right">
                ${{ priceFormat($order->total) }}
            </td>
        </tr>
    </table>
    <p style="font-size: 12px;color: #6b7280; margin-top: 24px; font-weight: 600">
        Recordá <a href="{{ $order->customerDetailPage() }}">adjuntar el comprobante</a> en el detalle de pedido
        apenas realices la transferencia
    </p>
@endif
