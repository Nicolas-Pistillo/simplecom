<?php 

namespace App\Enums;

enum PaymentRedirectType: string
{
    case ProviderPlatform = 'provider_platform';
    case FrontendCheckout = 'frontend_checkout';
    case None = 'none';
}