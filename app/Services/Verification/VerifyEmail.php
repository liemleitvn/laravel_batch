<?php


namespace App\Services\Verification;


use Illuminate\Support\Carbon;
use \Illuminate\Support\Facades\URL;

class VerifyEmail extends \Illuminate\Auth\Notifications\VerifyEmail
{
    protected function verificationUrl($notifiable)
    {
        return URL::temporarySignedRoute(
            'verification.verify', Carbon::now()->addMinute(30), ['id' => $notifiable->getKey()]
        );  //we use 30 minutes expiry
    }
}