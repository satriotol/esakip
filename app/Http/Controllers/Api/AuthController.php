<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);
        }

        $user = User::where('email', $request->email)->firstOrFail();

        $token = $user->createToken('auth_token')->plainTextToken;
        return $this->successResponse([
            'access_token' => $token,
            'token_type' => 'Bearer',
        ], 'Login Sukses');
    }
    public function checkRandomKey(Request $request)
    {
        try{
            $data = $request->validate([
                'random_key' => 'required',
                'opd_id' => 'required',
            ]);
            $randomKey = User::where('random_key', $data['random_key'])->where('opd_id', $request->opd_id)->firstOrFail();
            return $this->successResponse([
                'random_key' => $randomKey->random_key,
            ], 'Random Key Valid');
        } catch (\Throwable $th) {
            return $this->failedResponse(['message' => $th->getMessage()], $th->getMessage());
        }
    }
}
