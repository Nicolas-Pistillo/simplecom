<?php 

namespace App\Services;

use App\Enums\OrderFeedEvent;
use App\Enums\OrderFeedPresentation;
use App\Enums\OrderStatusCode;
use App\Enums\PaymentRedirectType;
use App\Interfaces\PaymentGateway;
use App\Models\Order;
use App\Models\OrderFeedItem;
use App\Traits\Configurable;

class BankTransfer implements PaymentGateway
{
    use Configurable;

    protected $configuration_keys = [
        'transfer_bank', 'transfer_account_owner', 'transfer_cbu', 'transfer_alias'
    ];

    public $redirect_type = PaymentRedirectType::None;

    public function generateCheckout(Order $order)
    {
        $order->update(['status_code' => OrderStatusCode::TransferPending]);

        $total = priceFormat($order->total);

        OrderFeedItem::create([
            'order_id'      => $order->id,
            'event'         => OrderFeedEvent::PaymentUpdate,
            'presentation'  => OrderFeedPresentation::Icon,
            'initializator' => $order->user->full_name,
            'action'        => "tiene que transferir $$total a tu cuenta de " . $this->key('transfer_bank'),
            'meta'          => [
                'icon_code' => 'overview'
            ]
        ]);
    }
}