<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Setup 2FA – PAI STAIMAS</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
    * { box-sizing: border-box; margin: 0; padding: 0; }
    body { min-height: 100vh; background: linear-gradient(135deg, #064e3b 0%, #0f766e 100%); display: flex; align-items: center; justify-content: center; font-family: 'Segoe UI', sans-serif; padding: 1rem; }
    .card { background: white; border-radius: 1.5rem; padding: 2.5rem; max-width: 480px; width: 100%; box-shadow: 0 25px 50px rgba(0,0,0,0.25); }
    .badge { display: inline-flex; align-items: center; gap: 0.5rem; background: #f0fdf4; color: #15803d; border: 1px solid #bbf7d0; border-radius: 9999px; padding: 0.25rem 0.75rem; font-size: 0.75rem; font-weight: 600; margin-bottom: 1.5rem; }
    h1 { font-size: 1.5rem; font-weight: 800; color: #111827; margin-bottom: 0.5rem; }
    p.sub { font-size: 0.875rem; color: #6b7280; line-height: 1.6; margin-bottom: 1.5rem; }
    .steps { counter-reset: step; list-style: none; margin-bottom: 1.5rem; }
    .steps li { counter-increment: step; display: flex; gap: 0.75rem; margin-bottom: 1rem; font-size: 0.875rem; color: #374151; align-items: flex-start; }
    .steps li::before { content: counter(step); background: #0f766e; color: white; border-radius: 9999px; width: 22px; height: 22px; display: flex; align-items: center; justify-content: center; font-size: 0.7rem; font-weight: 700; flex-shrink: 0; margin-top: 1px; }
    .qr-section { background: #f9fafb; border: 1px solid #e5e7eb; border-radius: 1rem; padding: 1.5rem; text-align: center; margin-bottom: 1.5rem; }
    .qr-placeholder { width: 160px; height: 160px; background: #e5e7eb; border-radius: 0.5rem; margin: 0 auto 1rem; display: flex; align-items: center; justify-content: center; font-size: 0.7rem; color: #6b7280; overflow: hidden; }
    .qr-placeholder img { width: 100%; height: 100%; }
    .secret-box { background: #1e293b; color: #34d399; font-family: monospace; font-size: 0.875rem; letter-spacing: 0.15em; padding: 0.75rem 1rem; border-radius: 0.5rem; user-select: all; word-break: break-all; margin-top: 0.5rem; cursor: copy; }
    .secret-label { font-size: 0.7rem; color: #6b7280; text-transform: uppercase; letter-spacing: 0.05em; }
    .form-group { margin-bottom: 1rem; }
    label { display: block; font-size: 0.75rem; font-weight: 600; color: #374151; margin-bottom: 0.35rem; text-transform: uppercase; letter-spacing: 0.05em; }
    input[type=text] { width: 100%; border: 1.5px solid #d1d5db; border-radius: 0.75rem; padding: 0.75rem 1rem; font-size: 1.25rem; letter-spacing: 0.2em; text-align: center; outline: none; transition: border-color .2s; }
    input[type=text]:focus { border-color: #0f766e; box-shadow: 0 0 0 3px rgba(15,118,110,0.1); }
    .error { color: #dc2626; font-size: 0.75rem; margin-top: 0.25rem; }
    .btn { display: block; width: 100%; padding: 0.875rem; background: linear-gradient(135deg, #0f766e, #0d9488); color: white; font-weight: 700; font-size: 0.9rem; border: none; border-radius: 0.75rem; cursor: pointer; transition: opacity .2s; }
    .btn:hover { opacity: 0.9; }
    .link-back { display: block; text-align: center; margin-top: 1rem; font-size: 0.8rem; color: #6b7280; }
    .link-back a { color: #0f766e; text-decoration: none; font-weight: 600; }
  </style>
</head>
<body>
  <div class="card">
    <span class="badge"><i class="fas fa-shield-alt"></i> Two-Factor Authentication</span>
    <h1>Setup Autentikasi 2FA</h1>
    <p class="sub">Lindungi akun admin Anda dengan lapisan keamanan ekstra menggunakan Google Authenticator atau Authy.</p>

    <ol class="steps">
      <li>Install <strong>Google Authenticator</strong> atau <strong>Authy</strong> di HP Anda</li>
      <li>Buka aplikasi → Tambah akun → Scan QR Code di bawah ini</li>
      <li>Masukkan 6-digit kode yang muncul di aplikasi untuk mengaktifkan</li>
    </ol>

    <div class="qr-section">
      <div class="qr-placeholder">
        <img src="https://api.qrserver.com/v1/create-qr-code/?size=160x160&data={{ urlencode($qrCodeUrl) }}" alt="QR Code 2FA">
      </div>
      <p class="secret-label">Atau masukkan secret key secara manual:</p>
      <div class="secret-box" title="Klik untuk menyalin">{{ $secret }}</div>
    </div>

    <form method="POST" action="{{ route('admin.2fa.activate') }}">
      @csrf
      <div class="form-group">
        <label>Kode OTP dari Aplikasi Authenticator</label>
        <input type="text" name="code" inputmode="numeric" maxlength="6" placeholder="000000" autocomplete="one-time-code" autofocus>
        @error('code')<p class="error">{{ $message }}</p>@enderror
      </div>
      <button type="submit" class="btn"><i class="fas fa-check-circle"></i> Aktifkan 2FA</button>
    </form>
    <span class="link-back"><a href="{{ route('admin.dashboard') }}">← Kembali ke Dashboard</a></span>
  </div>
</body>
</html>