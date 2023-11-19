<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\API\Programmers;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(LoginRequest $request): JsonResponse
    {
        /**
         * Melakukan pengecekan data apakah
         * data merupakan data yang valid
         * 
         */
        $data = $request->validated();

        /**
         * Mengambil data programmer dari tabel
         * berdasarkan email yang diberikan
         * 
         */
        $programmers = Programmers::where('email', $data['email'])->first();

        /**
         * Memeriksa apakah password yang
         * diberikan benar dan sesuai
         * 
         */
        $passwordIsCorrect = Hash::check($data['password'], $programmers->password);

        /**
         * Kembalikan unauthorize response jika
         * ada kesalahan pada email dan
         * password yang diberikan maka
         * 
         */
        if (!$programmers || !$passwordIsCorrect) {
            throw new HttpResponseException(response()->json([
                'errors' => 'Email atau password salah'
            ])->setStatusCode(401));
        }

        /**
         * Membuat token dan mendapatkan
         * token berupa string
         * 
         */
        $token = $programmers->createToken();

        /**
         * Kembalikan response yang sesuai
         * 
         */
        return response()->json([
            'success' => [
                'message' => 'Berhasil login'
            ],
            'token' => $token,
            'id_programmers' => $programmers['id']
        ])->setStatusCode(200);
    }

    public function logout(Request $request): JsonResponse
    {
        /**
         * Hapus token dari database
         * 
         */
        auth()->user()->token()->delete();

        /**
         * Kembalikan response yang sesuai
         * 
         */
        return response()->json([
            'success' => [
                'message' => 'Berhasil logout'
            ]
        ])->setStatusCode(200);
    }
}
