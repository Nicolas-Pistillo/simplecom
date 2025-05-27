<?php

namespace App\Enums;

enum MessageTopic: string
{
    case ContactForm = 'contact_form';
    case Product     = 'product';
    case Quote       = 'quote';
    case Order       = 'order';
    case Complaint   = 'complaint';
    case Suggestion  = 'suggestion';

    public function name(): string
    {
        return match($this)
        {
            MessageTopic::ContactForm => 'Consulta',
            MessageTopic::Quote       => 'Cotización',
            MessageTopic::Product     => 'Producto',
            MessageTopic::Order       => 'Pedido',
            MessageTopic::Complaint   => 'Reclamo',
            MessageTopic::Suggestion  => 'Sugerencia'
        };
    }

    public function color(): string
    {
        return match($this)
        {
            MessageTopic::ContactForm => 'blue',
            MessageTopic::Quote       => 'red',
            MessageTopic::Product     => 'green',
            MessageTopic::Order       => 'orange',
            MessageTopic::Complaint   => 'red',
            MessageTopic::Suggestion  => 'purple'
        };
    }
}