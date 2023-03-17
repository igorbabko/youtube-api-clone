<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EmailVerificationNotificationController extends Controller
{
    public function store(Request $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return response(['message' => 'Email has already been verified.']);
        }
        // if ($request->user()->hasVerifiedEmail()) {
        //     return redirect()->intended(RouteServiceProvider::HOME);
        // }

        $request->user()->sendEmailVerificationNotification();

        return response(['message' => 'A new verification link has been sent to the email address you provided during registration.']);
        // return response()->json(['status' => 'verification-link-sent']);
    }
}
