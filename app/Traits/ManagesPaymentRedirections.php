<?php

namespace App\Traits;

use App\Enums\PaymentRedirectType;

trait ManagesPaymentRedirections
{
    public PaymentRedirectType $redirect_type = PaymentRedirectType::ProviderPlatform;

    public string $provider_checkout_url;

    public $frontend_init_data, $frontend_payload;

    private string $base_url, $token;
}