<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function loginView()
    {
        return view('auth.login');
    }

    public function login(LoginRequest $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = $request->user();

            if ($user->role === 'admin' || $user->role === 'moderator') {
                Auth::login($user);

                return redirect()->route('home');
            } else {
                Auth::logout();
                return redirect()->route('login')->withErrors(['message' => 'Недостаточно прав для входа']);
            }
        } else {
            return redirect()->route('login')->withErrors(['message' => 'Неверный емейл или пароль']);
        }
    }
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
