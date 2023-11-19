<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    public function login(LoginRequest $request): JsonResponse
    {
        return response()->json([
            'success' => [
                'message' => 'Login berhasil'
            ]
        ])->setStatusCode(200);
    }
}
