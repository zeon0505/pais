<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin Panel – @yield('title', 'Dashboard') | PAI STAIMAS</title>
  <link rel="icon" type="image/png" href="{{ asset('assest/LOGO STAIMAS AI.png') }}" />
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <style>
    body { font-family: 'Plus Jakarta Sans', sans-serif; background: #f3f4f6; }
    /* Sidebar base */
    .sidebar-link {
      display: flex;
      align-items: center;
      gap: 10px;
      padding: 9px 14px;
      border-radius: 12px;
      font-size: 13px;
      font-weight: 500;
      color: #b2d8d8;
      text-decoration: none;
      transition: background 0.15s, color 0.15s;
      white-space: nowrap;
    }
    .sidebar-link:hover {
      background: rgba(255,255,255,0.10);
      color: #fff;
    }
    .sidebar-link.active {
      background: rgba(255,255,255,0.15);
      color: #fff;
      font-weight: 700;
    }
    .sidebar-link i {
      width: 16px;
      text-align: center;
      font-size: 13px;
      opacity: 0.8;
      flex-shrink: 0;
    }
    .sidebar-link.active i { opacity: 1; }
    .sidebar-section-title {
      font-size: 10px;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: 0.1em;
      color: #5f9ea0;
      padding: 10px 14px 4px;
    }
    /* Flash messages */
    .flash-success { background: #f0fdf4; border: 1px solid #bbf7d0; color: #15803d; padding: 12px 16px; border-radius: 12px; font-size: 14px; display: flex; align-items: center; gap: 10px; margin-bottom: 8px; }
    .flash-error   { background: #fef2f2; border: 1px solid #fecaca; color: #dc2626; padding: 12px 16px; border-radius: 12px; font-size: 14px; display: flex; align-items: center; gap: 10px; margin-bottom: 8px; }
  </style>
</head>
<body class="h-full" style="background:#f3f4f6;">
<div style="display:flex; height:100vh; overflow:hidden;">

  <!-- ═══ SIDEBAR ═══ -->
  <aside style="width:240px; background:#0d4f50; display:flex; flex-direction:column; flex-shrink:0; overflow-y:auto;">

    <!-- Logo -->
    <div style="padding:20px 18px 16px; border-bottom:1px solid rgba(255,255,255,0.08);">
      <div style="display:flex; align-items:center; gap:12px;">
        <div style="width:40px; height:40px; background:#fff; border-radius:12px; border:2px solid rgba(201,168,76,0.5); display:flex; align-items:center; justify-content:center; flex-shrink:0; overflow:hidden;">
          <img src="{{ asset('assest/LOGO STAIMAS AI.png') }}" alt="STAIMAS" style="width:100%; height:100%; object-fit:contain; padding:2px;">
        </div>
        <div>
          <div style="font-weight:800; color:#fff; font-size:14px; line-height:1.2;">PAI STAIMAS</div>
          <div style="font-size:10px; color:#5f9ea0; font-weight:700; text-transform:uppercase; letter-spacing:0.1em;">Admin Panel</div>
        </div>
      </div>
    </div>

    <!-- Nav -->
    <nav style="flex:1; padding:12px 10px; display:flex; flex-direction:column; gap:2px;">

      <div class="sidebar-section-title">Menu Utama</div>
      <a href="{{ route('admin.dashboard') }}" class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
        <i class="fas fa-th-large"></i>
        <span>Dashboard</span>
      </a>

      <div class="sidebar-section-title" style="margin-top:10px;">Konten Website</div>
      <a href="{{ route('admin.slides.index') }}" class="sidebar-link {{ request()->routeIs('admin.slides*') ? 'active' : '' }}">
        <i class="fas fa-images"></i>
        <span>Hero Slider</span>
      </a>
      <a href="{{ route('admin.beritas.index') }}" class="sidebar-link {{ request()->routeIs('admin.beritas*') ? 'active' : '' }}">
        <i class="fas fa-newspaper"></i>
        <span>Berita</span>
      </a>
      <a href="{{ route('admin.kategoris.index') }}" class="sidebar-link {{ request()->routeIs('admin.kategoris*') ? 'active' : '' }}">
        <i class="fas fa-tags"></i>
        <span>Kategori Berita</span>
      </a>
      <a href="{{ route('admin.posters.index') }}" class="sidebar-link {{ request()->routeIs('admin.posters*') ? 'active' : '' }}">
        <i class="fas fa-flag"></i>
        <span>Poster & Pengumuman</span>
      </a>

      <div class="sidebar-section-title" style="margin-top:10px;">Akademik</div>
      <a href="{{ route('admin.dosens.index') }}" class="sidebar-link {{ request()->routeIs('admin.dosens*') ? 'active' : '' }}">
        <i class="fas fa-user-tie"></i>
        <span>Dosen PAI</span>
      </a>
    </nav>

    <!-- User & Logout -->
    <div style="padding:14px 10px; border-top:1px solid rgba(255,255,255,0.08);">
      <div style="display:flex; align-items:center; gap:10px; padding:0 6px; margin-bottom:10px;">
        <div style="width:34px; height:34px; background:#0d7c7d; border-radius:10px; display:flex; align-items:center; justify-content:center; flex-shrink:0;">
          <i class="fas fa-user" style="color:#c9a84c; font-size:12px;"></i>
        </div>
        <div style="min-width:0;">
          <div style="color:#fff; font-size:12px; font-weight:700; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">{{ auth()->user()->name }}</div>
          <div style="color:#5f9ea0; font-size:10px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">{{ auth()->user()->email }}</div>
        </div>
      </div>
      <form action="{{ route('admin.logout') }}" method="POST" style="margin-bottom:6px;">
        @csrf
        <button type="submit" style="width:100%; display:flex; align-items:center; justify-content:center; gap:8px; background:rgba(255,255,255,0.08); color:#b2d8d8; border:none; padding:8px; border-radius:10px; font-size:12px; font-weight:600; cursor:pointer; transition:background 0.15s;" onmouseover="this.style.background='rgba(255,255,255,0.15)'" onmouseout="this.style.background='rgba(255,255,255,0.08)'">
          <i class="fas fa-sign-out-alt"></i> Logout
        </button>
      </form>
      <a href="{{ route('home') }}" target="_blank" style="display:flex; align-items:center; justify-content:center; gap:6px; color:#5f9ea0; font-size:11px; text-decoration:none; padding:4px;" onmouseover="this.style.color='#b2d8d8'" onmouseout="this.style.color='#5f9ea0'">
        <i class="fas fa-external-link-alt" style="font-size:9px;"></i> Lihat Website PAI
      </a>
    </div>
  </aside>

  <!-- ═══ MAIN AREA ═══ -->
  <div style="flex:1; display:flex; flex-direction:column; overflow:hidden; min-width:0;">

    <!-- Topbar -->
    <header style="background:#fff; border-bottom:1px solid #e5e7eb; padding:14px 24px; display:flex; align-items:center; justify-content:space-between; flex-shrink:0;">
      <div>
        <h1 style="font-weight:800; color:#111827; font-size:18px; margin:0;">@yield('title', 'Dashboard')</h1>
        @hasSection('breadcrumb')
        <p style="font-size:12px; color:#9ca3af; margin:2px 0 0;">@yield('breadcrumb')</p>
        @endif
      </div>
      <div style="display:flex; align-items:center; gap:10px;">
        @yield('header-action')
      </div>
    </header>

    <!-- Flash Messages -->
    <div style="padding: 16px 24px 0;">
      @if(session('success'))
      <div class="flash-success"><i class="fas fa-check-circle" style="color:#16a34a; flex-shrink:0;"></i> {{ session('success') }}</div>
      @endif
      @if(session('error'))
      <div class="flash-error"><i class="fas fa-exclamation-circle" style="color:#dc2626; flex-shrink:0;"></i> {{ session('error') }}</div>
      @endif
      @if($errors->any())
      <div class="flash-error" style="flex-direction:column; align-items:flex-start;">
        @foreach($errors->all() as $error)
        <div style="display:flex; align-items:center; gap:8px;"><i class="fas fa-times-circle" style="color:#dc2626; flex-shrink:0;"></i> {{ $error }}</div>
        @endforeach
      </div>
      @endif
    </div>

    <!-- Content -->
    <main style="flex:1; overflow-y:auto; padding:16px 24px 32px;">
      @yield('content')
    </main>

  </div>
</div>

<!-- ═══ DELETE CONFIRMATION MODAL ═══ -->
<div id="delete-modal" style="display:none; position:fixed; inset:0; z-index:9999; align-items:center; justify-content:center;">
  <!-- Backdrop -->
  <div id="delete-backdrop" style="position:absolute; inset:0; background:rgba(0,0,0,0.45); backdrop-filter:blur(4px);" onclick="closeDeleteModal()"></div>

  <!-- Card -->
  <div id="delete-card" style="position:relative; z-index:1; background:#fff; border-radius:24px; padding:32px; max-width:420px; width:90%; box-shadow:0 24px 60px -8px rgba(0,0,0,0.25); transform:scale(0.9) translateY(16px); transition:transform .25s ease, opacity .25s ease; opacity:0;">
    <!-- Icon -->
    <div style="width:64px; height:64px; background:#fef2f2; border-radius:50%; display:flex; align-items:center; justify-content:center; margin:0 auto 20px;">
      <i class="fas fa-trash-alt" style="color:#dc2626; font-size:24px;"></i>
    </div>

    <!-- Text -->
    <h3 style="text-align:center; font-size:18px; font-weight:800; color:#111827; margin:0 0 8px;">Hapus Data?</h3>
    <p id="delete-modal-msg" style="text-align:center; font-size:13px; color:#6b7280; margin:0 0 28px; line-height:1.6;">
      Data yang dihapus tidak dapat dikembalikan lagi.
    </p>

    <!-- Buttons -->
    <div style="display:flex; gap:12px;">
      <button onclick="closeDeleteModal()" style="flex:1; padding:11px; border-radius:12px; border:1.5px solid #e5e7eb; background:#f9fafb; color:#374151; font-size:13px; font-weight:700; cursor:pointer; transition:background .15s;" onmouseover="this.style.background='#f3f4f6'" onmouseout="this.style.background='#f9fafb'">
        <i class="fas fa-times" style="margin-right:6px;"></i>Batal
      </button>
      <button id="delete-confirm-btn" onclick="submitDeleteForm()" style="flex:1; padding:11px; border-radius:12px; border:none; background:#dc2626; color:#fff; font-size:13px; font-weight:700; cursor:pointer; transition:background .15s;" onmouseover="this.style.background='#b91c1c'" onmouseout="this.style.background='#dc2626'">
        <i class="fas fa-trash-alt" style="margin-right:6px;"></i>Ya, Hapus!
      </button>
    </div>
  </div>
</div>

<script>
  let _deleteForm = null;

  function confirmDelete(formEl, label) {
    _deleteForm = formEl;
    const msg = label
      ? 'Yakin ingin menghapus <strong>"' + label + '"</strong>? Data tidak dapat dikembalikan.'
      : 'Data yang dihapus tidak dapat dikembalikan lagi.';
    document.getElementById('delete-modal-msg').innerHTML = msg;

    const modal = document.getElementById('delete-modal');
    const card  = document.getElementById('delete-card');
    modal.style.display = 'flex';
    requestAnimationFrame(() => {
      card.style.transform  = 'scale(1) translateY(0)';
      card.style.opacity    = '1';
    });
  }

  function closeDeleteModal() {
    const modal = document.getElementById('delete-modal');
    const card  = document.getElementById('delete-card');
    card.style.transform = 'scale(0.9) translateY(16px)';
    card.style.opacity   = '0';
    setTimeout(() => { modal.style.display = 'none'; }, 220);
    _deleteForm = null;
  }

  function submitDeleteForm() {
    if (_deleteForm) {
      const btn = document.getElementById('delete-confirm-btn');
      btn.innerHTML = '<i class="fas fa-spinner fa-spin" style="margin-right:6px;"></i>Menghapus...';
      btn.disabled = true;
      _deleteForm.submit();
    }
  }

  // Close on ESC
  document.addEventListener('keydown', e => { if (e.key === 'Escape') closeDeleteModal(); });
</script>

</body>
</html>
