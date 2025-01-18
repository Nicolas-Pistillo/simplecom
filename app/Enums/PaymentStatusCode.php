<?php

namespace App\Enums;

enum PaymentStatusCode: string
{
    case Created               = 'created';
    case TransferPending       = 'transfer_pending';
    case Pending               = 'pay_pending';
    case NeedsConfirmation     = 'needs_confirmation';
    case InProcess             = 'payment_processing';
    case Unauthorized          = 'unauthorized';
    case InRevision            = 'in_revision';
    case InMediation           = 'in_mediation';
    case Processed             = 'processed';
    case Confirmed             = 'confirmed';
    case Rejected              = 'rejected';
    case CancellationInProcess = 'cancel_process';
    case Cancelled             = 'cancelled';
    case Refunded              = 'refunded';
}
