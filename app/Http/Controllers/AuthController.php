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

            Auth::login($user);

            $user->tokens()
                ->where('name', 'Token Name')
                ->delete();

            $user->createToken('Token Name')->plainTextToken;

            return redirect()->route('product.index');
        } else {
            return response()->json([
                'message' => 'Неверный емейл, или пароль'
            ], 400);
        }
    }
}
