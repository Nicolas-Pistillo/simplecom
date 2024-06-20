<?php 

namespace App\Enums;

enum ConfigurationTopics: string
{
    case EcommerceData = 'ecommerce_data';
    case Modules = 'modules';
    case Integrations = 'integrations';
}