<?php 

namespace App\Services;
use App\Models\EmailVerificationCode;
use App\Mail\EmailVerification;
use Illuminate\Support\Facades\Mail;

class EmailVerificationService
{
    public static function sendTo($email, $name)
    {
        $verificationModel = EmailVerificationCode::create([
            'ip'         => request()->ip(),
            'email'      => $email,
            'code'       => rand(100000, 999999),
            'expires_at' => now()->addMinutes(15)->toDateTimeString()
        ]);

        Mail::to($email)->send(new EmailVerification(tenant(), $name, $verificationModel->code));
    }

    public static function check($email, $code): bool
    {
        $verificationModel = EmailVerificationCode::where([
            'ip'    => request()->ip(),
            'email' => $email,
            'code'  => $code,
            'used'  => false
        ])->first();
        
        if ($verificationModel instanceof EmailVerificationCode && now()->lessThan($verificationModel->expires_at))
        {
            $verificationModel->update(['used' => true]);
            return true;
        }

        return false;
    }
}