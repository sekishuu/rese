<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Auth;

class CustomEmailVerificationRequest extends EmailVerificationRequest
{
    public function fulfill()
    {
        parent::fulfill();

        // 認証が完了した後にログアウト
        Auth::logout();
    }
}