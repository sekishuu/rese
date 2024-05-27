<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        
        if (Auth::attempt($credentials)) {
            // 認証に成功した場合、ホームページにリダイレクト
            return redirect()->intended('/');
        }

        // 認証に失敗した場合、ログインページにリダイレクト
        return redirect()->back()
            ->withErrors(['email' => 'The provided credentials do not match our records.'])
            ->withInput($request->only('email'));
    }

    public function logout(Request $request)
    {
        Auth::logout();

        return redirect('/');
    }
}
