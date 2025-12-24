<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Etiqueta de Envío</title>
</head>
<body style="font-family: Arial, sans-serif; font-size: 14px; margin: 0; padding: 0;">

    @foreach ($orders as $order)
        <table width="10cm" border="1" cellspacing="0" cellpadding="10" 
        style="border-radius: 8px; margin: 1cm auto; page-break-inside: avoid;">

            @if ($order->shipping)
                <!-- Header -->
                <tr>
                    <td colspan="2" style="padding: 10px; border: 0 !important">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td style="font-size: 12px;">
                                    <strong> {{ tenant('ecommerce_name') }}</strong><br>
                                    {{-- 787 Brunswick<br>
                                    Los Angeles<br>
                                    CA 50028<br>
                                    Tel. 4444 555 555 --}}
                                </td>
                                <td align="right">
                                    <img src="{{ tenant()->logo() }}" 
                                    alt="Logo aca" width="90" height="30" style="object-fit: contain">
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>

                <!-- Recipient -->
                <tr>
                    <td colspan="2" style="padding: 20px;">
                        <strong style="font-size: 18px;">{{ data_get($order, 'user.full_name') }}</strong><br>
                        {{ $order->user->tax_condition->name() }}<br>
                        <strong>
                            {{ $order->shipping->userAddress->street }} 
                            {{ $order->shipping->userAddress->number }}
                            CP {{ $order->shipping->userAddress->zipcode }}
                        </strong><br>
                        <strong>{{ $order->shipping->userAddress->locality->name }} - {{ $order->shipping->userAddress->province->name }}</strong><br>

                        @if (!empty($order->shipping->userAddress->floor))
                            <strong>Piso {{ $order->shipping->userAddress->floor }}</strong>    
                        @endif

                        @if (!empty($order->shipping->userAddress->apartment))
                            <strong>Depto {{ $order->shipping->userAddress->apartment }}</strong>    
                        @endif

                        @if (!empty($order->shipping->userAddress->office))
                            <strong>Oficina {{ $order->shipping->userAddress->office }}</strong>    
                        @endif
                    </td>
                </tr>

                <!-- Order Info -->
                <tr>
                    <td colspan="2" style="padding: 10px;">
                        <table width="100%" border="0" cellspacing="0" cellpadding="5">
                            <tr>
                                <td><strong>Pedido Nro</strong><br>{{ $order['id'] }}</td>
                                <td><strong>Fecha</strong><br> {{ $order->created_at->format('d/m/Y') }} </td>
                                <td><strong>Cant. Items</strong><br>{{ $order->total_items }}</td>
                            </tr>
                        </table>
                    </td>
                </tr>

                <!-- Barcode -->
                <tr>
                    <td colspan="2" align="center" style="padding: 20px;">
                        <img src="data:image/png;base64,{!! $order->qr_code !!}" width="80">
                    </td>
                </tr>

                <!-- Delivery Instruction -->
                @if (!empty($order->shipping->userAddress->details))
                    <tr>
                        <td colspan="2" align="center" style="font-size: 12px; padding: 10px;">
                            Observaciones: {{ $order->shipping->userAddress->details }}
                        </td>
                    </tr>
                @endif
            @else
                <!-- Header -->
                <tr>
                    <td colspan="2" style="padding: 10px; border: 0 !important">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td style="font-size: 12px;">
                                    <strong> {{ tenant('ecommerce_name') }}</strong><br>
                                    {{-- 787 Brunswick<br>
                                    Los Angeles<br>
                                    CA 50028<br>
                                    Tel. 4444 555 555 --}}
                                </td>
                                <td align="right">
                                    <img src="{{ tenant()->logo() }}" 
                                    alt="Logo aca" width="90" height="30" style="object-fit: contain">
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>

                <!-- Recipient -->
                <tr>
                    <td colspan="2" style="padding: 20px;">
                        <strong style="font-size: 18px;">{{ data_get($order, 'user.full_name') }}</strong><br>
                        {{ $order->user->tax_condition->name() }}<br>
                        <strong>
                            Retira en: {{ $order->storePickup->name }}
                        </strong><br>

                        {{ $order->storePickup->address }}
                    </td>
                </tr>

                <!-- Order Info -->
                <tr>
                    <td colspan="2" style="padding: 10px;">
                        <table width="100%" border="0" cellspacing="0" cellpadding="5">
                            <tr>
                                <td><strong>Pedido Nro</strong><br>{{ $order['id'] }}</td>
                                <td><strong>Fecha</strong><br> {{ $order->created_at->format('d/m/Y') }} </td>
                                <td><strong>Cant. Items</strong><br>{{ $order->total_items }}</td>
                            </tr>
                        </table>
                    </td>
                </tr>

                <!-- Barcode -->
                <tr>
                    <td colspan="2" align="center" style="padding: 20px;">
                        <img src="data:image/png;base64,{!! $order->qr_code !!}" width="80">
                    </td>
                </tr>

                <!-- Delivery Instruction -->
                @if (!empty($order->shipping->userAddress->details))
                    <tr>
                        <td colspan="2" align="center" style="font-size: 12px; padding: 10px;">
                            Observaciones: {{ $order->shipping->userAddress->details }}
                        </td>
                    </tr>
                @endif
            @endif
        </table>
    @endforeach
</body>
</html>
