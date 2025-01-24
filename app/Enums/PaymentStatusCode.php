<?php

namespace App\Enums;

use function Ramsey\Uuid\v1;

enum PaymentStatusCode: string
{
    case Created               = 'created';
    case TransferPending       = 'transfer_pending';
    case Pending               = 'pending';
    case NeedsConfirmation     = 'needs_confirmation';
    case InProcess             = 'processing';
    case Unauthorized          = 'unauthorized';
    case Authorized            = 'authorized';
    case ProviderClaimed       = 'provider_claimed';
    case InRevision            = 'in_revision';
    case InMediation           = 'in_mediation';
    case Processed             = 'processed';
    case Confirmed             = 'confirmed';
    case Rejected              = 'rejected';
    case CancellationInProcess = 'cancel_process';
    case Cancelled             = 'cancelled';
    case CustomerCancelled     = 'customer_cancelled';
    case Refunded              = 'refunded';

    public function icon(): string
    {
        return match($this)
        {
            PaymentStatusCode::Created => 'more_horiz',
            PaymentStatusCode::TransferPending => 'account_balance',
            PaymentStatusCode::Pending => 'more_horiz',
            PaymentStatusCode::NeedsConfirmation => 'lock',
            PaymentStatusCode::InProcess => 'more_horiz',
            PaymentStatusCode::Authorized => 'check',
            PaymentStatusCode::Unauthorized => 'close',
            PaymentStatusCode::ProviderClaimed => 'description',
            PaymentStatusCode::InRevision => 'policy',
            PaymentStatusCode::InMediation => 'quick_reference',
            PaymentStatusCode::Processed => 'check',
            PaymentStatusCode::Confirmed => 'check',
            PaymentStatusCode::Rejected => 'close',
            PaymentStatusCode::CancellationInProcess => 'more_horiz',
            PaymentStatusCode::Cancelled => 'close',
            PaymentStatusCode::CustomerCancelled => 'close',
            PaymentStatusCode::Refunded => 'cached',
        };
    }
}
