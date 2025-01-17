<?php

namespace App\Enums;

enum PaymentStatusCode: string
{
    case CreationPending       = 'created';
    case PayPending            = 'pay_pending';
    case NeedsConfirmation     = 'needs_confirmation';
    case InProcess             = 'payment_processing';
    case Processed             = 'processed';
    case Confirmed             = 'confirmed';
    case ProviderCancelled     = 'provider_cancelled';
    case CancellationInProcess = 'cancel_process';
    case Cancelled             = 'cancelled';
    case Unauthorized          = 'unauthorized';
    case InRevision            = 'in_revision';
    case Refunded              = 'refunded';
}
