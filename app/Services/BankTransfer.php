<?php 

namespace App\Services;

use App\Enums\PaymentRedirectType;
use App\Traits\Configurable;

class BankTransfer
{
    use Configurable;

    protected $configuration_keys = ['transfer_bank', 'transfer_account_owner', 'transfer_cbu', 'transfer_alias'];

    public $redirect_type = PaymentRedirectType::None;
}