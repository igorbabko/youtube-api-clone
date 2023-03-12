<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    public function show(Request $request)
    {
        return $request->user();
    }

    public function update(Request $request)
    {
        $attributes = $request->validate([
            'name' => ['string'],
            'email' => ['string', 'email', Rule::unique('users')->ignore($request->user())],
            'password' => ['confirmed', Password::defaults()],
        ]);

        $request->user()->fill($attributes)->save();

        return response()->noContent();
    }
}
