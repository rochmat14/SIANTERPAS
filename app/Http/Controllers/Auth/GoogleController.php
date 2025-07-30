<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\UserDescription;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use App\User;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->stateless()->user();

            // Cek apakah user sudah ada di tabel `users`
            $user = User::where('email', $googleUser->getEmail())->first();

            if (!$user) {
                // Buat user baru jika belum ada
                $activation_code = Str::random(60) . $googleUser->getEmail();

                $user = User::create([
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'password' => Hash::make(Str::random(12)), // Password random untuk keamanan
                    'status' => 1,
                    'verified_status' => 1, // Karena menggunakan Google, bisa langsung dianggap verified
                    'activation_code' => $activation_code
                ]);

                // Sinkronkan role sebagai "members"
                $user->syncRoles('members');
                $user->save();

                // Simpan data ke tabel `ms_users_description`
                $description = new UserDescription();
                $description->users_id = $user->id;
                $description->nama_depan = $googleUser->getName();
                $description->nama_belakang = null; // Bisa diisi data tambahan jika tersedia dari Google
                $description->jenis_kelamin = null;
                $description->tempat_lahir = null;
                $description->tanggal_lahir = null;
                $description->tanggal_masuk = now();
                $description->alamat_rumah = null;
                $description->status = 1;
                $description->created_by = $user->id;
                $description->save();
            }

            // Login user
            Auth::login($user);

            // Redirect ke halaman dashboard atau tujuan lain
            return redirect()->intended('/members');
        } catch (\Exception $e) {
            return redirect('/login')->withErrors('Gagal login menggunakan Google.');
        }
    }
}
