<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }

        return view('auth.login');
    }
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            // Data tambahan ini terpisah dari status autentikasi
            session(['last_login' => now()]);

            return redirect()->intended(route('dashboard'))
                ->with('success', 'Login berhasil!');
        }

        return back()
            ->withErrors(['email' => 'Email atau password salah'])
            ->onlyInput('email');
    }

    //logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('auth.login');
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        //$googleUser = Socialite::driver('google')->user();

        //Development only
        $googleUser = Socialite::driver('google')
            ->setHttpClient(new Client(['verify' => false]))
            ->stateless()
            ->user();

        $email_user = $googleUser->email;
        //dd($email_user);

        // Cari user berdasarkan email
         $user = User::where('email', $email_user)->first();
        // jika ada redirect ke dashboard
        // jika tidak, kirim error ke halaman login
        // jika ada redirect ke dashboard
        if($user){

            Auth::login($user);

            // Data tambahan ini terpisah dari status autentikasi
            session(['last_login' => now()]);
            session('company', 'PCR');

            return redirect()->route('dashboard')
                ->with('success', 'Login berhasil!');
        }

        return redirect()->route('login')
            ->withErrors(['email' => 'Email tidak terdaftar']);

        /** Kode untuk autentikasi dan redirect */

    }
}
