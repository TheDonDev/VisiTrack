<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $visitNumber = session('visit_number') ?? 'default_visit_number'; // Fallback value
            return redirect()->route('visit.status', ['visit' => $visitNumber])->with('success', 'Login successful!');
        }

        return redirect()->back()->withErrors(['email' => 'Invalid credentials.']);
    }

    public function signup(Request $request)
    {
        $userCount = User::count();
        if ($userCount >= 5) {
            return redirect()->back()->withErrors(['email' => 'User limit reached. Only 5 users can sign up.']);
        }

        $request->validate([
            'username' => 'required|string|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);

        $user = new User();
        $user->username = $request->username; // Save the username
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('security.login')->with('success', 'Signup successful! Please log in.');
    }
}
