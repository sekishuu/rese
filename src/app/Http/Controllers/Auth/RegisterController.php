<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
       User::create([
            'name' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'user_type' => 'general', 
        ]);

        return redirect()->route('thanks');
    }
}
