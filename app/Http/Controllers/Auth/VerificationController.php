<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Auth\Events\Verified;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\User;

class VerificationController extends Controller
{
    public function verify(Request $request)
    {
        // Fetch the user by ID from the request route
        $user = User::find($request->route('id'));

        if (!$user) {
            return redirect()->route('index')->with('error', 'User not found.');
        }

        if ($request->route('hash') != sha1($user->getEmailForVerification())) {
            return redirect()->route('index')->with('error', 'Invalid verification link.');
        }

        if ($user->hasVerifiedEmail()) {
            return redirect()->route('index')->with('success', 'Email already verified.');
        }

        if ($user->markEmailAsVerified()) {
            event(new Verified($user));
            return redirect()->route('index')->with('success', 'Email verified successfully!');
        }

        return redirect()->route('index')->with('error', 'Could not verify email.');
    }
}
