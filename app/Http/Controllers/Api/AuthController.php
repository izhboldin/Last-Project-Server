<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\CreateImageForUserException;
use App\Http\Controllers\Controller;
use App\Http\Requests\ImageRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\ImageResource;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Services\ImageService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    private $imageService;

    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }

    public function register(RegisterRequest $request)
    {
        try {
            $user = User::create([
                'name' => $request->get('name'),
                'email' => $request->get('email'),
                'phone' => $request->get('phone'),
                'password' => Hash::make($request->get('password')),
            ])->fresh();
        } catch (\Exception $e) {
            return $e->getMessage();
        }

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
        if (Auth::check()) {
            $request->user()->currentAccessToken()->delete();
            return response()->json(['message' => 'Logged out'], 200);
        }

        return response()->json(['message' => 'No user to log out'], 200);
    }

    //ImageRequest
    public function uploadImage(ImageRequest $request)
    {
        $data = $request->validated();
        $user = $request->user();
        try {
            $images = $this->imageService->upload($user, $data, true, true);
        } catch (CreateImageForUserException $e) {
            return new JsonResponse([
                'message' => $e->getMessage(),
            ], 400);
        }

        return ImageResource::collection($images);
    }
}
