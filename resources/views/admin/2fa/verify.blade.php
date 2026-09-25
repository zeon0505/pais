<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Verifikasi 2FA – PAI STAIMAS</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
    * { box-sizing: border-box; margin: 0; padding: 0; }
    body { min-height: 100vh; background: linear-gradient(135deg, #064e3b 0%, #0f766e 100%); display: flex; align-items: center; justify-content: center; font-family: 'Segoe UI', sans-serif; padding: 1rem; }
    .card { background: white; border-radius: 1.5rem; padding: 2.5rem; max-width: 400px; width: 100%; box-shadow: 0 25px 50px rgba(0,0,0,0.25); text-align: center; }
    .icon-wrap { width: 70px; height: 70px; background: linear-gradient(135deg, #064e3b, #0f766e); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.5rem; }
    .icon-wrap i { font-size: 1.75rem; color: white; }
    h1 { font-size: 1.5rem; font-weight: 800; color: #111827; margin-bottom: 0.5rem; }
    p.sub { font-size: 0.875rem; color: #6b7280; margin-bottom: 1.75rem; line-height: 1.6; }
    .otp-input { width: 100%; border: 2px solid #e5e7eb; border-radius: 0.875rem; padding: 1rem; font-size: 1.75rem; letter-spacing: 0.5em; text-align: center; outline: none; transition: border-color .2s; color: #111827; font-weight: 700; }
    .otp-input:focus { border-color: #0f766e; box-shadow: 0 0 0 4px rgba(15,118,110,0.1); }
    .error { color: #dc2626; font-size: 0.8rem; margin: 0.5rem 0; }
    .btn { display: block; width: 100%; padding: 0.9rem; background: linear-gradient(135deg, #064e3b, #0f766e); color: white; font-weight: 700; font-size: 0.95rem; border: none; border-radius: 0.875rem; cursor: pointer; margin-top: 1.25rem; transition: opacity .2s; }
    .btn:hover { opacity: 0.9; }
    .link-back { display: block; text-align: center; margin-top: 1rem; font-size: 0.8rem; }
    .link-back a { color: #6b7280; text-decoration: none; }
    .link-back a:hover { color: #0f766e; }
  </style>
</head>
<body>
  <div class="card">
    <div class="icon-wrap"><i class="fas fa-mobile-alt"></i></div>
    <h1>Verifikasi 2FA</h1>
    <p class="sub">Buka aplikasi <strong>Google Authenticator</strong> atau <strong>Authy</strong> di HP Anda dan masukkan kode 6 digit yang muncul.</p>

    <form method="POST" action="{{ route('admin.2fa.verify') }}">
      @csrf
      <input type="text" name="code" class="otp-input" inputmode="numeric" maxlength="6" placeholder="000000" autocomplete="one-time-code" autofocus>
      @error('code')<p class="error">{{ $message }}</p>@enderror
      <button type="submit" class="btn"><i class="fas fa-sign-in-alt"></i> Masuk ke Dashboard</button>
    </form>
    <span class="link-back"><a href="{{ route('admin.login') }}">← Kembali ke halaman login</a></span>
  </div>
</body>
</html>