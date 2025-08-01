<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Mail\VerifyMail;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard'; // Default redirect jika tidak ada role-specific redirection

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function sendFailedLoginResponse(Request $request)
    {
        throw ValidationException::withMessages([
            $this->username() => ['Email atau password yang Anda masukkan salah. Silakan coba lagi.'],
        ]);
    }

    public function authenticated(Request $request, $user)
    {
        // Cek apakah user terverifikasi
        if ($user->verified_status != 1) {
            \Mail::to($user->email)->send(new VerifyMail($user));
            $this->guard()->logout();
            return back()->with('status', 'Mohon Maaf! Anda perlu mem-verifikasi akun Anda Terlebih Dahulu. Kami telah mengirimkan kode aktivasi, Silakan periksa email Anda untuk proses aktivasi.');
        }
        // Perbarui informasi login terakhir
        $user->update(['last_login' => now()]);

        // Redirect berdasarkan role user
        if ($user->hasRole('Members')) {
            return redirect('/members');
        }

        // Default redirect untuk role lain
        return redirect('/dashboard');
    }

    protected function credentials(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $credentials['status'] = 1; // Hanya user dengan status aktif yang bisa login
        return $credentials;
    }

    protected function loggedOut(Request $request)
    {
        return redirect()->route('login');
    }
}
