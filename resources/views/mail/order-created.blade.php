@extends('layouts.mail.tenant')

@section('title', 'Recibimos tu pedido')

@section('mail-width', '600px')

@section('content')
    <p style="margin-bottom: 0">Aca va a ir un poco de texto para acompañar el mensaje de contexto de pedido recibido</p>

    <div role="separator" style="line-height: 32px;">&zwj;</div>

    <p style="font-size: 16px; line-height: 22px; color: #6b7280; margin: 0">
        Detalle del pedido
    </p>

    <p><b style="font-size: 24px">Pedido {{ $order->id }}</b></p> <br>

    @foreach ($order->items as $item)
        <table style="width: 100%" cellpadding="0" cellspacing="0" role="none">
            <tr>
                <td style="width: 72px; vertical-align: top">
                    <img src="{{ $item->product->first_image }}"
                    alt="{{ $item->name }}" width="48"
                    style="max-width: 100%; vertical-align: middle; border-radius: 8px">
                </td>
                <td class="sm-w-auto"
                    style="width: 400px; text-align: left; vertical-align: top; font-size: 16px; color: #111827">
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
                    {{-- <p style="margin: 0 0 8px; color: #2dac62">
                        20% OFF
                    </p> --}}
                    <p style="margin: 0; min-width: 120px; font-weight: 700; color: #111827">
                        ${{ priceFormat($item->sell_price) }}
                    </p>
                </td>
            </tr>
        </table>

        <div role="separator" style="line-height: 24px;">&zwj;</div>
    @endforeach

    <div role="separator" style="height: 2px; line-height: 2px;"></div>

    <div align="right" class="sm-text-left">
        <table class="sm-w-full" cellpadding="0" cellspacing="0" role="none">
            <tr>
                <td style="font-size: 12px; line-height: 16px; color: #6b7280">
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
                    <td style="font-size: 12px; line-height: 16px; color: #6b7280">
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
                <td style="font-size: 12px; line-height: 16px; color: #6b7280">
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

    <div role="separator" style="line-height: 64px;">&zwj;</div>

    <table style="width: 100%" cellpadding="0" cellspacing="0" role="none">
        <tr>
            <td>
                <h2 style="margin: 0 0 32px; font-size: 28px; line-height: 30px; font-weight: 400; color: #111827">
                    Customer information
                </h2>
                <table style="width: 100%" cellpadding="0" cellspacing="0" role="none">
                    <tr>
                        <td class="sm-inline-block sm-w-full sm-px-0"
                            style="width: 50%; padding: 0 8px 32px 0; vertical-align: top">
                            <h4 style="margin: 0 0 8px; font-size: 16px; line-height: 22px; color: #6b7280">
                                Shipping address
                            </h4>
                            <p style="margin: 0; font-size: 16px; line-height: 22px; color: #6b7280">
                                Steve Shipper
                                <br>
                                Shipping Company
                                <br>
                                123 Shipping Street
                                <br>
                                Shippington KY 40150
                                <br>
                                United States
                            </p>
                        </td>
                        <td class="sm-inline-block sm-w-full sm-px-0"
                            style="width: 50%; padding: 0 0 32px 8px; vertical-align: top">
                            <h4 style="margin: 0 0 8px; font-size: 16px; line-height: 22px; color: #6b7280">
                                Billing address
                            </h4>
                            <p style="margin: 0; font-size: 16px; line-height: 22px; color: #6b7280">
                                Bob Biller
                                <br>
                                My Company
                                <br>
                                123 Billing Street
                                <br>
                                Billtown KY K2P0B0
                                <br>
                                United States
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td class="sm-inline-block sm-w-full sm-px-0"
                            style="width: 50%; padding: 0 8px 32px 0; vertical-align: top">
                            <h4 style="margin: 0 0 8px; font-size: 16px; line-height: 22px; color: #6b7280">
                                Shipping method
                            </h4>
                            <p style="margin: 0; font-size: 16px; line-height: 22px; color: #6b7280">
                                Generic Shipping
                                <br>
                                $0
                            </p>
                        </td>
                        <td class="sm-inline-block sm-w-full sm-px-0"
                            style="width: 50%; padding: 0 0 32px 8px; vertical-align: top">
                            <h4 style="margin: 0 0 8px; font-size: 16px; line-height: 22px; color: #6b7280">
                                Payment method
                            </h4>
                            <table cellpadding="0" cellspacing="0" role="none">
                                <tr>
                                    <td>
                                        <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAOEAAADhCAMAAAAJbSJIAAABKVBMVEX///8VNMz///7//f/9//////oVNMv///z///kAKsluftBretP///f7////+/8VNMkHLcQVM88VNcUAHrvY3vUWMtP///QVMtQSN8MAKsX///H3//8AJsUQOMMAJ8oAI8Xp9P8AKNAAI7wAI7D1+v8ALb9qfMkAHscYMNwTOL2erOMAL72yv+cAIbXu+f9LWcd9i9TM1fSuuOyTnuhzgd9ZaNNAUccyRMQ0RMBlddivwN1edsVyhMyLnuDB0vNkb8RodbZBYLkSOK0AE8RSX8EkPqlsg9mquehAUrcAB6nL1/He4fzc6vuQo+imq+cpQLx+kdAPLrCJm82CidfDy/YAFJaerNaYq/oFKKuKl826wvNMbM9LWs0GKN9BUNjt7P9keOSpq8lOWNSC/7pGAAAV50lEQVR4nO1ba1fbOpeWLdtygm1FTnzLPSEhV27tlJYWwtuWlr4hB8op0+Gc0w4z7///EbPlXCw7gZ7MWjOf9HTBorEs6ZG2tp69pSAkISEhISEhISEhISEhISEhISEhISEhISEhISEhISEhISEhISEhISEhISEhISEhISEhISEhISEhISEhISEhISEhISEhIfF/BFWHXxh+iIrXHsafYIw0TSebXtagBEap94ilIv5vvSpCUp+qRNfgk/VGVZ1gQmzCu5R5RBD0I/UGb11fryP1ko7jAppt29oKtrb4z7wa6M0mhqrtOHZcVHiVaNAv3XGSz+bPsSrWQQC6g4FDpXn84uW/vTp5/fr1m8PTo+/j6yZ/jGHkzWyjwFDHZZ8goacIVWzrOYaaTfS37/byO6enO+vI5/fOzicVv2xrGwjCQONS+oW9/EXJd6Aj2otMVf94VJMOq75FeI3N+6/vP3R7rULB4KCFqNruDl69PG4CCVPPzqGKsan6peHRXtLgXn7v63MEkab76OJjNSpsRL1Vz0X7l8dorTE+oiYM6lkx9cIoetPxwSL9ymU1XdWnjmhfDtDtTM5u6z/7geK6TKGu61JDYUwxKKt3P+XHB35sDiJBS9X15uduq55U283V62HlOYbEQvbk5auw2OozhQOGUln+YUC7YU2pd/9E+oZXgcpskH7Baw+5iWELHsQfLJ/m9pAu2IGDKldfqjnm1lwXaEFLHHGDLh0M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"
                                            alt="VISA" width="40" style="max-width: 100%; vertical-align: bottom">
                                    </td>
                                    <td style="padding-left: 8px">
                                        <p style="margin: 0; font-size: 16px; line-height: 22px; color: #6b7280">
                                            ************4242 — $478</p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <div style="text-align: left">

        <div role="separator"
            style="height: 1px; line-height: 1px; `background-color: ${color}; `margin-top: ${spaceY}; margin-bottom: ${spaceY}; `margin-left: ${spaceX}; margin-right: ${spaceX}; margin: 64px 0 16px; `margin-right: ${right}` }}` }}` }}` }}` }}">
            &zwj;</div>

        <p style="margin: 0; font-size: 12px; line-height: 16px; color: #6b7280">
            If you have any questions, reply to this email or contact us at <a href="mailto:hello@example.com"
                class="hover-text-decoration-underline">hello@example.com</a></p>
        <table style="width: 100%" cellpadding="0" cellspacing="0" role="none">
            <tr>
                <td>
                    <p style="margin: 16px 0 0; font-size: 12px; line-height: 16px; color: #6b7280">&copy; ShopName. All
                        rights reserved.</p>
                </td>
            </tr>
        </table>
    </div>
@endsection
