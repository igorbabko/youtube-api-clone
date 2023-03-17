<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

class VerifyEmailController extends Controller
{
    public function __invoke(EmailVerificationRequest $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return response(['message' => 'Email has already been verified.']);
            // return redirect()->intended(
            //     config('app.frontend_url').RouteServiceProvider::HOME.'?verified=1'
            // );
        }

        $request->user()->markEmailAsVerified();
        // $request->fullfill();

        // if ($request->user()->markEmailAsVerified()) {
        //     event(new Verified($request->user()));
        // }

        return response(['message' => 'Email has been successfully verified.']);
        // return redirect()->intended(
        //     config('app.frontend_url').RouteServiceProvider::HOME.'?verified=1'
        // );
    }
}
