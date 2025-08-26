<?php 

namespace App\Enums;

enum IncentiveType: string
{
    case Promotion = 'promotion';
    case Payment   = 'payment';
    case Shipping  = 'shipping';
    case Security  = 'security';
    case Warranty  = 'warranty';
    case Returns   = 'returns';
    case Support   = 'support';
    case Other     = 'other';

    public function name(): string
    {
        return match($this)
        {
            self::Promotion => 'Promociones',
            self::Payment   => 'Medios de pago',
            self::Shipping  => 'Envíos',
            self::Security  => 'Seguridad',
            self::Warranty  => 'Garantía',
            self::Returns   => 'Devoluciones',
            self::Support   => 'Soporte',
            self::Other     => 'Otros'
        };
    }

    public function icon(): string
    {
        return match($this)
        {
            self::Promotion => 'attach_money',
            self::Payment   => 'credit_card',
            self::Shipping  => 'delivery_truck_speed',
            self::Security  => 'verified_user',
            self::Warranty  => 'verified',
            self::Returns   => 'compare_arrows',
            self::Support   => 'headset_mic',
            self::Other     => 'info'
        };
    }
}