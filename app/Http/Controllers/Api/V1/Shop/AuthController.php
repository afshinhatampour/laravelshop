<?php

namespace App\Http\Controllers\Api\V1\Shop;

use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\Shop\Auth\LoginRequest;
use App\Http\Requests\Shop\Auth\RegisterRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\Response as HttpFoundationResponse;

class AuthController extends ApiController
{
    /**
     * @param LoginRequest $request
     * @return JsonResponse
     */
    public function login(LoginRequest $request): JsonResponse
    {
        return Auth::attempt($request->validated()) ?
            $this->userLoginResponse() : $this->userNotFoundResponse();
    }

    /**
     * @return JsonResponse
     */
    public function getAuthUser(): JsonResponse
    {
        return $this->success('', Auth::user());
    }

    /**
     * @return JsonResponse
     */
    private function userLoginResponse(): JsonResponse
    {
        $userToken = Auth::user()->createToken('shop');
        return $this->success('you are logged in', [
            'token' => $userToken->accessToken,
            'user'  => Auth::user()
        ]);
    }

    /**
     * @return JsonResponse
     */
    private function userNotFoundResponse(): JsonResponse
    {
        return $this->error('user not found', HttpFoundationResponse::HTTP_NOT_FOUND);
    }

    public function register(RegisterRequest $request)
    {
    }
}
