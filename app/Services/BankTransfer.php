<?php 

namespace App\Services;

use App\Enums\OrderFeedEvent;
use App\Enums\OrderFeedPresentation;
use App\Enums\OrderStatus;
use App\Enums\PaymentRedirectType;
use App\Enums\PaymentStatus;
use App\Interfaces\PaymentGateway;
use App\Models\Order;
use App\Models\OrderFeedItem;
use App\Models\OrderPayment;
use App\Models\PaymentMethod;
use App\Traits\Configurable;

class BankTransfer implements PaymentGateway
{
    use Configurable;

    protected $configuration_keys = [
        'transfer_bank', 'transfer_account_owner', 'transfer_cbu', 'transfer_alias'
    ];

    public $redirect_type = PaymentRedirectType::None;

    public function model(): PaymentMethod
    {
        return PaymentMethod::where('code', 'transfer')->first();
    }

    public function generateCheckout(Order $order)
    {
        $order->update(['status' => OrderStatus::PaymentPending]);

        OrderPayment::create([
            'order_id'    => $order->id,
            'provider_id' => $this->model()->id,
            'status'      => PaymentStatus::TransferPending
        ]);

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