<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\CreateImageForUserException;
use App\Exceptions\RegisterApiException;
use App\Http\Controllers\Controller;
use App\Http\Requests\ImageRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\ImageResource;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Services\AuthApiService;
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
    private $authApiService;

    public function __construct(ImageService $imageService, AuthApiService $authApiService)
    {
        $this->imageService = $imageService;
        $this->authApiService = $authApiService;
    }

    public function register(RegisterRequest $request)
    {
        try {
            $user = $this->authApiService->register($request);
            $token = $user->createToken('Token Name')->plainTextToken;
        } catch (RegisterApiException $e) {
            return $e->getMessage();
        }

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

    public function uploadImage(ImageRequest $request)
    {
        $this->authorize('updateImage', User::class);

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
