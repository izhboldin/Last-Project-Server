<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class SocialLoginApiController extends Controller
{
    public function authRedirect()
    {
        return Socialite::driver('google')->redirect();
    }
}
