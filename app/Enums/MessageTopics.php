<?php

namespace App\Enums;

enum MessageTopics: string
{
    case ContactForm = 'contact_form';
    case Quote       = 'quote';
    case Order       = 'order';
    case Complaint   = 'complaint';
    case Suggestion  = 'suggestion';

    public function name(): string
    {
        return match($this)
        {
            MessageTopics::ContactForm => 'Consulta',
            MessageTopics::Quote       => 'Cotización',
            MessageTopics::Order       => 'Pedido',
            MessageTopics::Complaint   => 'Reclamo',
            MessageTopics::Suggestion  => 'Sugerencia'
        };
    }

    public function color(): string
    {
        return match($this)
        {
            MessageTopics::ContactForm => 'blue',
            MessageTopics::Quote       => 'green',
            MessageTopics::Order       => 'orange',
            MessageTopics::Complaint   => 'red',
            MessageTopics::Suggestion  => 'purple'
        };
    }
}