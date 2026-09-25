<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PragmaRX\Google2FA\Google2FA;

class TwoFactorController extends Controller
{
    protected Google2FA $google2fa;

    public function __construct()
    {
        $this->google2fa = new Google2FA();
    }

    // ── STEP 1: Tampilkan form setup QR code ──
    public function setup()
    {
        $user = Auth::user();

        if ($user->google2fa_enabled) {
            return redirect()->route('admin.2fa.verify');
        }

        $secret = $user->google2fa_secret ?? $this->google2fa->generateSecretKey();

        // Simpan secret sementara bila belum ada
        if (!$user->google2fa_secret) {
            $user->update(['google2fa_secret' => $secret]);
        }

        $qrCodeUrl = $this->google2fa->getQRCodeUrl(
            config('app.name', 'PAI STAIMAS'),
            $user->email,
            $secret
        );

        return view('admin.2fa.setup', compact('secret', 'qrCodeUrl'));
    }

    // ── STEP 2: Aktifkan 2FA setelah scan QR ──
    public function activate(Request $request)
    {
        $request->validate(['code' => 'required|digits:6']);

        $user = Auth::user();
        $valid = $this->google2fa->verifyKey($user->google2fa_secret, $request->code);

        if (!$valid) {
            return back()->withErrors(['code' => 'Kode OTP tidak valid. Pastikan waktu HP Anda sudah sinkron.']);
        }

        $user->update(['google2fa_enabled' => true]);

        return redirect()->route('admin.dashboard')->with('success', '✅ Two-Factor Authentication berhasil diaktifkan!');
    }

    // ── STEP 3: Tampilkan form verifikasi OTP saat login ──
    public function verifyForm()
    {
        if (!session('2fa_user_id')) {
            return redirect()->route('admin.login');
        }

        return view('admin.2fa.verify');
    }

    // ── STEP 4: Proses verifikasi OTP ──
    public function verify(Request $request)
    {
        $request->validate(['code' => 'required|digits:6']);

        $userId = session('2fa_user_id');
        if (!$userId) {
            return redirect()->route('admin.login');
        }

        $user = \App\Models\User::findOrFail($userId);
        $valid = $this->google2fa->verifyKey($user->google2fa_secret, $request->code);

        if (!$valid) {
            return back()->withErrors(['code' => 'Kode OTP salah atau sudah kadaluarsa.']);
        }

        // Login user sepenuhnya
        Auth::login($user);
        session()->forget('2fa_user_id');
        $request->session()->regenerate();

        return redirect()->route('admin.dashboard');
    }

    // ── Nonaktifkan 2FA ──
    public function disable(Request $request)
    {
        $request->validate(['code' => 'required|digits:6']);

        $user = Auth::user();
        $valid = $this->google2fa->verifyKey($user->google2fa_secret, $request->code);

        if (!$valid) {
            return back()->withErrors(['code' => 'Kode OTP salah.']);
        }

        $user->update(['google2fa_enabled' => false, 'google2fa_secret' => null]);

        return redirect()->route('admin.dashboard')->with('success', '2FA berhasil dinonaktifkan.');
    }
}