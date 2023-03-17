<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

class VerifyEmailController extends Controller
{
    public function __invoke(EmailVerificationRequest $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return response(['message' => 'Email has been already verified.']);
        }

        $request->user()->markEmailAsVerified();

        return response(['message' => 'Email has been successfully verified.']);
    }
}
