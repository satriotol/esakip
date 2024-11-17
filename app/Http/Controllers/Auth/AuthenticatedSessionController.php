<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {
        $user = User::where('email', $request->email)->where('password', '')->first();
        if ($user) {
            $user->update([
                'password' => Hash::make($request->password)
            ]);
        }

        $request->authenticate();

        $request->session()->regenerate();
        $user = Auth::user();
        $user->update(
            [
                'last_signin_at' => now(),
                'random_key' => Str::random(60),
            ]
        );

        return redirect()->intended(RouteServiceProvider::HOME);
    }
    public function loginEksekutif(Request $request)
    {
        $email = 'eksekutif@semarangkota.go.id';
        $password = 'eksekutif@semarangkota.go.id';
        $dataToken = $request->query('token');
        $token = $this->get_user_by_token($dataToken);
        if ($token == 200) {
            if ($email && $password) {
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
        } else {
            return redirect(route('home'));
        }
    }
    public function login_myinspektorat(Request $request)
    {
        // Send a POST request to the external API
        $checkUser = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer 1|LRBeNUVPEh5zIFzM0KIwgHBDqOLUVI7ehEhsItNF78d770c8'
        ])->post('http://myinspektorat.inspektorat.semarangkota.go.id/api/portal/getUser', [
            'uuid' => $request->uuid,
            'token' => $request->token,
        ]);

        // Check if the API response is successful
        if ($checkUser->status() == 200) {
            // Extract user information from the API response
            $userData = $checkUser->json();
            $email = 'admin_penilaian@semarangkota.go.id';

            // Find the user by email in the local database
            $user = User::where('email', $email)->first();

            if ($user) {
                // If the user exists, log them in
                auth()->login($user);
                return redirect()->intended(RouteServiceProvider::HOME);
            } else {
                // If the user does not exist, throw a validation exception
                throw ValidationException::withMessages([
                    'email' => ['Email atau password salah.'],
                ]);
            }
        }

        // Redirect to the home page if the API response is not successful
        return redirect(route('home'));
    }
    public function get_user_by_token($token)
    {
        $data = Http::withHeaders([
            'X-API-KEY' => '17109224B18EA10BFB6C9F01528BEE8A',
        ])->get('https://eksekutif.semarangkota.go.id/api/user/get_user?token=' . $token);
        return $data->status();
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        if (Auth::user()->email == 'eksekutif@semarangkota.go.id') {
            $back = 'https://eksekutif.semarangkota.go.id/administrator/user/profile';
        } else {
            $back = '/';
        }
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();
        return redirect($back);
    }
}
