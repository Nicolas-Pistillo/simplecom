<?php 

namespace App\Enums;

enum ConfigurationTopics: string
{
    case EcommerceData = 'ecommerce_data';
    case Modules = 'modules';
    case Integrations = 'integrations';
    case PaymentMethods = 'payment_methods';
    case DeliveryMethods = 'delivery_methods';
}