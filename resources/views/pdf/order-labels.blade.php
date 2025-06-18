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
            <!-- Header -->
            <tr>
                <td colspan="2" style="padding: 10px; border: 0 !important">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <td style="font-size: 12px;">
                                <strong> {{ tenant('ecommerce_name') }}</strong><br>
                                787 Brunswick<br>
                                Los Angeles<br>
                                CA 50028<br>
                                Tel. 4444 555 555
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
                    {{ TaxCondition::tryFrom(data_get($order, 'user.tax_condition'))->name() }}<br>
                    <strong>New York</strong><br>
                    <strong>NY 10013</strong><br>
                    <strong>USA</strong>
                </td>
            </tr>

            <!-- Order Info -->
            <tr>
                <td colspan="2" style="padding: 10px;">
                    <table width="100%" border="0" cellspacing="0" cellpadding="5">
                        <tr>
                            <td><strong>Pedido Nro:</strong><br>{{ $order['id'] }}</td>
                            <td><strong>Reference:</strong><br>PO456461</td>
                            <td><strong>Weight:</strong><br>1.5KG</td>
                        </tr>
                    </table>
                </td>
            </tr>

            <!-- Barcode -->
            <tr>
                <td colspan="2" align="center" style="padding: 20px;">
                    <!-- Reemplaza esta imagen con una generada dinámicamente si es necesario -->
                    <img src="barcode.png" alt="Barcode" height="60">
                </td>
            </tr>

            <!-- Delivery Instruction -->
            <tr>
                <td colspan="2" align="center" style="font-size: 12px; padding: 10px;">
                    Delivery Instruction: Please leave with reception
                </td>
            </tr>
        </table>
    @endforeach
</body>
</html>
