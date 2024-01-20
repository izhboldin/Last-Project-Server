<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {

        $user = User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
        ])->fresh();


        $token = $user->createToken('Token Name')->plainTextToken;

        return [
            'user' => new UserResource($user),
            'token' => $token,
        ];
    }

    public function login(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = $request->user();


            $user->tokens()
                ->where('name', 'Token Name')
                ->delete();
            $token = $user->createToken('Token Name')->plainTextToken;

            return [
                'token' => $token,
                'user' =>  new UserResource($user),
            ];
        } else {
            return response()->json([
                'message' => 'Неверный емейл, или пароль'
            ], 400);
        }
    }

    public function logout(Request $request)
    {
        Session::flush();

        return response()->json([
            'message' => 'Successfully logged out'
        ], 200);
    }
}
