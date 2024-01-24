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
    public function login_lopissemar(Request $request)
    {
        $checkUser = Http::withHeaders([
            'Accept' => 'application/json',
        ])->post('http://myinspektorat.inspektorat.semarangkota.go.id/api/portal/getUser', [
            'uuid' => $request->uuid
        ]);
        if ($checkUser->status() == 200) {
            $email = 'admin_penilaian@semarangkota.go.id';
            $password = 'penilaiansakip12345';
            $user = User::where('email', $email)->first();
            if ($user && Hash::check($password, $user->password)) {
                // Jika otentikasi berhasil
                auth()->login($user);
                return redirect()->intended(RouteServiceProvider::HOME);
            } else {
                // Jika otentikasi gagal
                throw ValidationException::withMessages([
                    'email' => ['Email atau password salah.'],
                ]);
            }
        }
        return redirect(route('home.index'));
    }
}
