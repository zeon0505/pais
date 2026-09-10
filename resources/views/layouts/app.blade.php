<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ $title ?? 'PAI STAIMAS Wonogiri' }} – Pendidikan Agama Islam S1</title>
  <meta name="description" content="{{ $description ?? 'Program Studi Pendidikan Agama Islam (PAI) S1 STAIMAS Wonogiri – Mencetak Guru PAI yang Kompeten, Unggul, dan Berjiwa Edupreneurship.' }}" />
  <link rel="icon" type="image/png" href="{{ asset('assest/LOGO STAIMAS AI.png') }}" />
  
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

  @vite(['resources/css/app.css', 'resources/js/app.js'])

  <style>
    .topbar-hidden { transform: translateY(-100%); margin-bottom: -40px; }
    .navbar-scrolled {
      background-color: rgba(255,255,255,0.95) !important;
      backdrop-filter: blur(10px);
      box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);
      border-bottom: 1px solid rgba(229,231,235,0.8);
    }

    /* ── PAGE LOAD ANIMATION ── */
    @keyframes fadeInDown {
      from { opacity: 0; transform: translateY(-20px); }
      to   { opacity: 1; transform: translateY(0); }
    }
    @keyframes fadeInUp {
      from { opacity: 0; transform: translateY(30px); }
      to   { opacity: 1; transform: translateY(0); }
    }
    @keyframes fadeInLeft {
      from { opacity: 0; transform: translateX(-30px); }
      to   { opacity: 1; transform: translateX(0); }
    }
    @keyframes fadeInRight {
      from { opacity: 0; transform: translateX(30px); }
      to   { opacity: 1; transform: translateX(0); }
    }
    @keyframes scaleIn {
      from { opacity: 0; transform: scale(0.92); }
      to   { opacity: 1; transform: scale(1); }
    }
    @keyframes shimmer {
      0%   { background-position: -200% center; }
      100% { background-position:  200% center; }
    }
    @keyframes pulse-soft {
      0%, 100% { opacity: 1; }
      50%       { opacity: .6; }
    }
    @keyframes slideInFromRight {
      from { opacity: 0; transform: translate3d(20px, 0, 0); }
      to   { opacity: 1; transform: translate3d(0, 0, 0); }
    }
    @keyframes slideInFromLeft {
      from { opacity: 0; transform: translate3d(-20px, 0, 0); }
      to   { opacity: 1; transform: translate3d(0, 0, 0); }
    }

    /* Set class entrance untuk memicu transisi selembut sutra */
    .slide-from-right {
      animation: slideInFromRight 0.32s cubic-bezier(0.25, 0.46, 0.45, 0.94) both;
    }
    .slide-from-left {
      animation: slideInFromLeft 0.32s cubic-bezier(0.25, 0.46, 0.45, 0.94) both;
    }

    body {
      overflow-x: hidden;
      background-color: #f3f4f6; /* Pastikan background body solid abu-abu, bukan putih blink */
    }
    #page-wrapper {
      will-change: transform, opacity;
      transform: translate3d(0, 0, 0);
    }


    /* Navbar slide down */
    #navbar { animation: fadeInDown .4s ease .05s both; }

    /* Hero breadcrumb + heading */
    .page-hero-title { animation: fadeInUp .5s ease .1s both; }
    .page-hero-sub   { animation: fadeInUp .5s ease .2s both; }

    /* ── SCROLL REVEAL ── */
    .reveal {
      opacity: 0;
      transform: translateY(28px);
      transition: opacity .55s ease, transform .55s ease;
    }
    .reveal.visible {
      opacity: 1;
      transform: translateY(0);
    }
    .reveal-left  { opacity: 0; transform: translateX(-28px); transition: opacity .55s ease, transform .55s ease; }
    .reveal-right { opacity: 0; transform: translateX(28px);  transition: opacity .55s ease, transform .55s ease; }
    .reveal-left.visible, .reveal-right.visible { opacity: 1; transform: translate(0); }
    .reveal-scale { opacity: 0; transform: scale(.93); transition: opacity .5s ease, transform .5s ease; }
    .reveal-scale.visible { opacity: 1; transform: scale(1); }

    /* Stagger delay helpers */
    .delay-100 { transition-delay: .1s !important; }
    .delay-200 { transition-delay: .2s !important; }
    .delay-300 { transition-delay: .3s !important; }
    .delay-400 { transition-delay: .4s !important; }
    .delay-500 { transition-delay: .5s !important; }

    /* ── CARD HOVER LIFT ── */
    .card-hover {
      transition: transform .25s ease, box-shadow .25s ease;
    }
    .card-hover:hover {
      transform: translateY(-4px);
      box-shadow: 0 16px 40px -8px rgba(0,0,0,.12);
    }

    /* ── LOGO FLOAT ── */
    #navbar .logo-icon { animation: float 4s ease-in-out infinite; }

    /* ── NAV LINK UNDERLINE ── */
    nav a.nav-link {
      position: relative;
      padding-bottom: 2px;
    }
    nav a.nav-link::after {
      content: '';
      position: absolute;
      bottom: -2px; left: 0;
      width: 0; height: 2px;
      background: #0d7c7d;
      border-radius: 9999px;
      transition: width .25s ease;
    }
    nav a.nav-link:hover::after,
    nav a.nav-link.active::after { width: 100%; }


      /* ── DROPDOWN CSS ── */
    .dropdown-group { position: relative; }
    .dropdown-menu {
      visibility: hidden;
      opacity: 0;
      position: absolute;
      top: 100%;
      left: 0;
      background-color: white;
      min-width: 220px;
      padding: 0.5rem 0;
      border-radius: 0.5rem;
      box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
      border: 1px solid #f3f4f6;
      transform: translateY(10px);
      transition: all 0.2s ease;
      z-index: 50;
    }
    .dropdown-group:hover .dropdown-menu {
      visibility: visible;
      opacity: 1;
      transform: translateY(0);
    }
    .dropdown-item {
      display: block;
      padding: 0.5rem 1rem;
      font-size: 0.875rem;
      color: #4b5563;
      transition: all 0.15s ease;
    }
    .dropdown-item:hover {
      background-color: #f3f4f6;
      color: #0f766e;
    }
    
    /* Mobile Submenu */
    .mobile-submenu { display: none; background: #f9fafb; padding-left: 1rem; border-left: 2px solid #0f766e; margin-top: 0.5rem; }
    .mobile-submenu.open { display: block; }
  </style>
</head>
<body class="bg-gray-50 text-gray-800 antialiased font-sans">

  <!-- TOP BAR -->
  <div class="bg-[#074e50] text-gray-200 text-xs py-2 px-4 z-50 relative transition-all duration-300" id="topbar">
    <div class="max-w-7xl mx-auto flex flex-col sm:flex-row justify-between items-center gap-2">
      <div class="flex items-center gap-4">
        <a href="tel:082223204552" class="hover:text-yellow-400 transition-colors"><i class="fas fa-phone mr-1.5 text-yellow-400"></i> 082223204552</a>
        <a href="mailto:staimaswonogiri@gmail.com" class="hover:text-yellow-400 transition-colors"><i class="fas fa-envelope mr-1.5 text-yellow-400"></i> staimaswonogiri@gmail.com</a>
      </div>
      <div class="flex items-center gap-4">
        <a href="https://staimaswonogiri.ecampuz.com/eadmisi/" target="_blank" class="bg-yellow-500 text-gray-900 px-3 py-1 rounded font-semibold hover:bg-yellow-600 transition-colors"><i class="fas fa-user-plus mr-1"></i> PMB 2026</a>
        <div class="flex items-center gap-2.5 ml-2 border-l border-teal-700 pl-3">
          <a href="https://www.facebook.com/people/staimaswonogiri/100068071263429/" target="_blank" class="hover:text-yellow-400"><i class="fab fa-facebook-f"></i></a>
          <a href="https://www.instagram.com/staimaswonogiri/" target="_blank" class="hover:text-yellow-400"><i class="fab fa-instagram"></i></a>
          <a href="https://www.youtube.com/@STAIMASWONOGIRI/featured" target="_blank" class="hover:text-yellow-400"><i class="fab fa-youtube"></i></a>
        </div>
      </div>
    </div>
  </div>

  <!-- NAVBAR -->
  <header class="sticky top-0 bg-white border-b border-gray-100 z-40 transition-all duration-300" id="navbar">
    <div class="max-w-7xl mx-auto px-4 py-3 flex justify-between items-center">
      <a href="{{ route('home') }}" class="flex items-center gap-3 group">
        <div class="logo-icon w-12 h-12 bg-white rounded-full flex items-center justify-center border-2 border-yellow-500 shadow-md overflow-hidden">
          <img src="{{ asset('assest/PAI.jpeg') }}" alt="PAI Logo" class="w-full h-full object-contain p-0.5">
        </div>
        <div>
          <span class="block text-lg font-extrabold text-teal-700 tracking-tight leading-none">PAI STAIMAS</span>
          <span class="text-xs font-semibold text-yellow-500 tracking-widest uppercase">Wonogiri</span>
        </div>
      </a>

            <nav class="hidden lg:block">
        <ul class="flex items-center gap-6 text-[14px] font-medium text-gray-600">
          
          <!-- BERANDA -->
          <li>
            <a href="{{ route('home') }}" class="nav-link hover:text-teal-700 transition-colors py-2 {{ request()->routeIs('home') ? 'font-bold text-teal-700 active' : '' }}">BERANDA</a>
          </li>

          <!-- PROFIL -->
          <li class="dropdown-group py-2">
            <a href="#" class="nav-link hover:text-teal-700 transition-colors flex items-center gap-1 {{ request()->routeIs('pages.sejarah', 'pages.visi-misi', 'pages.struktur-organisasi', 'pages.dosen*', 'pages.akreditasi') ? 'font-bold text-teal-700 active' : '' }}">
              PROFIL <i class="fas fa-chevron-down text-[10px]"></i>
            </a>
            <div class="dropdown-menu">
              <a href="{{ route('pages.sejarah') }}" class="dropdown-item">Sejarah</a>
              <a href="{{ route('pages.visi-misi') }}" class="dropdown-item">Visi Misi & Tujuan (VMTS)</a>
              <a href="{{ route('pages.struktur-organisasi') }}" class="dropdown-item">Struktur Organisasi</a>
              <a href="{{ route('pages.dosen') }}" class="dropdown-item">Daftar Dosen</a>
              <a href="{{ route('pages.akreditasi') }}" class="dropdown-item">Status Izin & Akreditasi</a>
            </div>
          </li>

          <!-- AKADEMIK -->
          <li class="dropdown-group py-2">
            <a href="#" class="nav-link hover:text-teal-700 transition-colors flex items-center gap-1 {{ request()->routeIs('pages.kurikulum', 'pages.rps', 'pages.kalender-akademik', 'pages.panduan-ta', 'pages.pedoman-ppl', 'pages.lab-microteaching') ? 'font-bold text-teal-700 active' : '' }}">
              AKADEMIK <i class="fas fa-chevron-down text-[10px]"></i>
            </a>
            <div class="dropdown-menu">
              <a href="{{ route('pages.kurikulum') }}" class="dropdown-item">Kurikulum</a>
              <a href="{{ route('pages.rps') }}" class="dropdown-item">RPS</a>
              <a href="{{ route('pages.kalender-akademik') }}" class="dropdown-item">Kalender Akademik</a>
              <a href="{{ route('pages.panduan-ta') }}" class="dropdown-item">Panduan Tugas Akhir</a>
              <a href="{{ route('pages.pedoman-ppl') }}" class="dropdown-item">Pedoman PPL</a>
              <a href="{{ route('pages.lab-microteaching') }}" class="dropdown-item">Lab Microteaching</a>
            </div>
          </li>

          <!-- PMB & KEMAHASISWAAN -->
          <li class="dropdown-group py-2">
            <a href="#" class="nav-link hover:text-teal-700 transition-colors flex items-center gap-1 {{ request()->routeIs('pages.info-pmb', 'pages.kegiatan-prestasi') ? 'font-bold text-teal-700 active' : '' }}">
              KEMAHASISWAAN <i class="fas fa-chevron-down text-[10px]"></i>
            </a>
            <div class="dropdown-menu">
              <a href="{{ route('pages.info-pmb') }}" class="dropdown-item">Info Pendaftaran Maba</a>
              <a href="{{ route('pages.kegiatan-prestasi') }}" class="dropdown-item">Kegiatan & Prestasi</a>
            </div>
          </li>

          <!-- TRIDHARMA -->
          <li class="dropdown-group py-2">
            <a href="#" class="nav-link hover:text-teal-700 transition-colors flex items-center gap-1 {{ request()->routeIs('pages.penelitian', 'pages.pengabdian', 'pages.kerjasama', 'pages.jurnal') ? 'font-bold text-teal-700 active' : '' }}">
              TRIDHARMA <i class="fas fa-chevron-down text-[10px]"></i>
            </a>
            <div class="dropdown-menu">
              <a href="{{ route('pages.penelitian') }}" class="dropdown-item">Penelitian</a>
              <a href="{{ route('pages.pengabdian') }}" class="dropdown-item">Pengabdian Masyarakat</a>
              <a href="{{ route('pages.kerjasama') }}" class="dropdown-item">Kerjasama/MoU</a>
              <a href="{{ route('pages.jurnal') }}" class="dropdown-item">Jurnal Prodi PAI</a>
            </div>
          </li>

          <!-- AKREDITASI -->
          <li>
            <a href="{{ route('pages.dokumen-akreditasi') }}" class="nav-link hover:text-teal-700 transition-colors py-2 {{ request()->routeIs('pages.dokumen-akreditasi') ? 'font-bold text-teal-700 active' : '' }}">DOKUMEN LAMDIK</a>
          </li>

        </ul>
      </nav>

      <div class="flex items-center gap-3">
        <a href="https://staimaswonogiri.ecampuz.com/eadmisi/" target="_blank" class="hidden lg:inline-flex items-center gap-2 bg-teal-700 hover:bg-teal-800 text-white px-4 py-2 rounded-lg font-semibold text-sm transition-colors shadow">
          <i class="fas fa-graduation-cap"></i> PMB 2026
        </a>
        <button class="lg:hidden text-gray-600 hover:text-teal-700 text-2xl p-1" id="nav-toggle">
          <i class="fas fa-bars"></i>
        </button>
      </div>
    </div>

        <!-- Mobile Dropdown -->
    <div class="mobile-dropdown lg:hidden border-t border-gray-100 bg-white shadow-lg" id="mobile-menu">
      <ul class="flex flex-col px-4 py-2 text-sm font-semibold text-gray-700">
        <li><a href="{{ route('home') }}" class="block py-3 border-b border-gray-100 hover:text-teal-700"><i class="fas fa-home w-5 text-teal-600"></i> Beranda</a></li>
        
        <!-- Mobile Profil -->
        <li>
          <div class="flex justify-between items-center py-3 border-b border-gray-100 hover:text-teal-700 cursor-pointer" onclick="toggleSubmenu('mob-profil')">
            <span><i class="fas fa-id-card w-5 text-teal-600"></i> Profil</span>
            <i class="fas fa-chevron-down text-xs"></i>
          </div>
          <div id="mob-profil" class="mobile-submenu">
            <a href="{{ route('pages.sejarah') }}" class="block py-2 text-gray-600">Sejarah</a>
            <a href="{{ route('pages.visi-misi') }}" class="block py-2 text-gray-600">Visi Misi & Tujuan (VMTS)</a>
            <a href="{{ route('pages.struktur-organisasi') }}" class="block py-2 text-gray-600">Struktur Organisasi</a>
            <a href="{{ route('pages.dosen') }}" class="block py-2 text-gray-600">Daftar Dosen</a>
            <a href="{{ route('pages.akreditasi') }}" class="block py-2 text-gray-600">Status Izin & Akreditasi</a>
          </div>
        </li>

        <!-- Mobile Akademik -->
        <li>
          <div class="flex justify-between items-center py-3 border-b border-gray-100 hover:text-teal-700 cursor-pointer" onclick="toggleSubmenu('mob-akademik')">
            <span><i class="fas fa-book w-5 text-teal-600"></i> Akademik</span>
            <i class="fas fa-chevron-down text-xs"></i>
          </div>
          <div id="mob-akademik" class="mobile-submenu">
            <a href="{{ route('pages.kurikulum') }}" class="block py-2 text-gray-600">Kurikulum</a>
            <a href="{{ route('pages.rps') }}" class="block py-2 text-gray-600">RPS</a>
            <a href="{{ route('pages.kalender-akademik') }}" class="block py-2 text-gray-600">Kalender Akademik</a>
            <a href="{{ route('pages.panduan-ta') }}" class="block py-2 text-gray-600">Panduan Tugas Akhir</a>
            <a href="{{ route('pages.pedoman-ppl') }}" class="block py-2 text-gray-600">Pedoman PPL</a>
            <a href="{{ route('pages.lab-microteaching') }}" class="block py-2 text-gray-600">Lab Microteaching</a>
          </div>
        </li>

        <!-- Mobile Kemahasiswaan -->
        <li>
          <div class="flex justify-between items-center py-3 border-b border-gray-100 hover:text-teal-700 cursor-pointer" onclick="toggleSubmenu('mob-mhs')">
            <span><i class="fas fa-users w-5 text-teal-600"></i> Kemahasiswaan</span>
            <i class="fas fa-chevron-down text-xs"></i>
          </div>
          <div id="mob-mhs" class="mobile-submenu">
            <a href="{{ route('pages.info-pmb') }}" class="block py-2 text-gray-600">Info Pendaftaran Maba</a>
            <a href="{{ route('pages.kegiatan-prestasi') }}" class="block py-2 text-gray-600">Kegiatan & Prestasi</a>
          </div>
        </li>

        <!-- Mobile Tridharma -->
        <li>
          <div class="flex justify-between items-center py-3 border-b border-gray-100 hover:text-teal-700 cursor-pointer" onclick="toggleSubmenu('mob-tri')">
            <span><i class="fas fa-hand-holding-heart w-5 text-teal-600"></i> Tridharma</span>
            <i class="fas fa-chevron-down text-xs"></i>
          </div>
          <div id="mob-tri" class="mobile-submenu">
            <a href="{{ route('pages.penelitian') }}" class="block py-2 text-gray-600">Penelitian</a>
            <a href="{{ route('pages.pengabdian') }}" class="block py-2 text-gray-600">Pengabdian Masyarakat</a>
            <a href="{{ route('pages.kerjasama') }}" class="block py-2 text-gray-600">Kerjasama/MoU</a>
            <a href="{{ route('pages.jurnal') }}" class="block py-2 text-gray-600">Jurnal Prodi PAI</a>
          </div>
        </li>

        <li><a href="{{ route('pages.dokumen-akreditasi') }}" class="block py-3 border-b border-gray-100 hover:text-teal-700"><i class="fas fa-certificate w-5 text-teal-600"></i> Dokumen Akreditasi</a></li>
        
        <li class="py-4">
          <a href="https://staimaswonogiri.ecampuz.com/eadmisi/" target="_blank" class="flex justify-center items-center gap-2 bg-teal-700 hover:bg-teal-800 text-white py-3 rounded-xl font-bold text-sm shadow transition-colors">
            <i class="fas fa-graduation-cap"></i> Daftar PMB 2026
          </a>
        </li>
      </ul>
    </div>
  </header>

  <script>
    function toggleSubmenu(id) {
      document.getElementById(id).classList.toggle('open');
    }
  </script>

  <!-- WRAPPER UNTUK TRANSISI -->
  <div id="page-wrapper">
    <!-- PAGE HERO -->
    @if(isset($title) && !request()->routeIs('home'))
    <section class="bg-gradient-to-br from-teal-800 to-teal-600 text-white py-12 px-4 overflow-hidden relative">
      <div class="absolute inset-0 opacity-10" style="background-image:radial-gradient(circle at 80% 50%, rgba(201,168,76,.6) 0%, transparent 60%);"></div>
      <div class="max-w-7xl mx-auto relative">
        <div class="page-hero-title flex items-center gap-2 text-sm text-teal-200 mb-3">
          <a href="{{ route('home') }}" class="hover:text-white transition-colors">Beranda</a>
          <span>/</span>
          <span class="text-white font-medium">{{ $title }}</span>
        </div>
        <h1 class="page-hero-title text-3xl sm:text-4xl font-extrabold">{{ $title }}</h1>
        @if(isset($subtitle))<p class="page-hero-sub text-teal-100 mt-2 text-base">{{ $subtitle }}</p>@endif
      </div>
    </section>
    @endif

    <!-- KONTEN UTAMA -->
    <main class="max-w-7xl mx-auto px-4 py-12">
      @yield('content')
    </main>
  </div>

  <!-- FOOTER -->
  <footer class="bg-teal-900 text-gray-300">
    <div class="max-w-7xl mx-auto px-4 py-12 grid grid-cols-1 md:grid-cols-3 gap-8 text-xs">
      <div class="space-y-3">
        <h3 class="font-extrabold text-white text-sm">Prodi PAI STAIMAS Wonogiri</h3>
        <p class="text-gray-400 leading-relaxed">Mendidik sarjana Pendidikan Agama Islam yang profesional, unggul, dan berjiwa edupreneurship.</p>
      </div>
      <div class="space-y-3">
        <h4 class="font-extrabold text-white text-xs uppercase tracking-wider">Akses Cepat</h4>
        <ul class="space-y-2">
          <li><a href="{{ route('home') }}" class="hover:text-yellow-400">Beranda</a></li>
          <li><a href="{{ route('pages.visi-misi') }}" class="hover:text-yellow-400">Visi & Misi</a></li>
          <li><a href="{{ route('pages.dosen') }}" class="hover:text-yellow-400">Dosen Pengajar</a></li>
          <li><a href="{{ route('pages.kurikulum') }}" class="hover:text-yellow-400">Unduh Kurikulum</a></li>
        </ul>
      </div>
      <div class="space-y-3">
        <h4 class="font-extrabold text-white text-xs uppercase tracking-wider">Kontak & Informasi</h4>
        <p class="text-gray-400">Jl. Cempaka 6, Wonoboyo, Wonogiri 57615</p>
        <p class="text-gray-400">WhatsApp: 082223204552</p>
      </div>
    </div>
    <div class="border-t border-teal-800 py-4 text-center text-[10px] text-gray-500">
      <p>© 2026 Program Studi Pendidikan Agama Islam STAIMAS Wonogiri. All Rights Reserved.</p>
    </div>
  </footer>




<script>
/* ── Scroll Reveal (Intersection Observer) ── */
(function () {
  const targets = document.querySelectorAll('.reveal, .reveal-left, .reveal-right, .reveal-scale');
  if (!targets.length) return;
  const io = new IntersectionObserver((entries) => {
    entries.forEach(e => {
      if (e.isIntersecting) {
        e.target.classList.add('visible');
        io.unobserve(e.target);
      }
    });
  }, { threshold: 0.12 });
  targets.forEach(el => io.observe(el));
})();

/* ── Auto attach .reveal to common elements ── */
(function () {
  setTimeout(() => {
    const selectors = [
      'main .bg-white:not(.no-reveal)',
      'main article',
      'main .grid > div',
      'main .grid > a',
      'main section > div',
    ];
    selectors.forEach(sel => {
      document.querySelectorAll(sel).forEach((el, i) => {
        if (!el.classList.contains('reveal') &&
            !el.classList.contains('reveal-left') &&
            !el.classList.contains('reveal-scale') &&
            !el.closest('.no-reveal')) {
          el.classList.add('reveal');
          if (i < 6) el.style.transitionDelay = (i * 0.05) + 's';
        }
      });
    });

    /* Re-run IO on newly tagged elements */
    const targets = document.querySelectorAll('.reveal:not(.visible), .reveal-left:not(.visible), .reveal-right:not(.visible), .reveal-scale:not(.visible)');
    const io = new IntersectionObserver((entries) => {
      entries.forEach(e => { if (e.isIntersecting) { e.target.classList.add('visible'); io.unobserve(e.target); } });
    }, { threshold: 0.05 });
    targets.forEach(el => io.observe(el));
  }, 320);
})();
/* ── Intelligent Directed Page Slide Transition ── */
(function () {
  const wrapper = document.getElementById('page-wrapper');
  if (!wrapper) return;

  // List pathnames in order of header menu
  const menuOrder = [
    '/',
    '/visi-misi',
    '/dosen',
    '/kurikulum',
    '/berita'
  ];

  function getPathIndex(path) {
    if (path === '/' || path === '') return 0;
    // Check for partial match (like /berita/some-slug)
    for (let i = 0; i < menuOrder.length; i++) {
      if (menuOrder[i] !== '/' && path.startsWith(menuOrder[i])) {
        return i;
      }
    }
    return 0;
  }

  // 1. Play Entrance Animation based on stored direction
  const slideDir = sessionStorage.getItem('slide_dir');
  if (slideDir === 'left') {
    wrapper.classList.add('slide-from-left');
  } else if (slideDir === 'right') {
    wrapper.classList.add('slide-from-right');
  }
  sessionStorage.removeItem('slide_dir'); // clear after use

  // 2. Intercept local link clicks to detect direction
  document.addEventListener('click', function (e) {
    const a = e.target.closest('a');
    if (!a) return;
    const href = a.getAttribute('href');
    if (!href || href.startsWith('#') || href.startsWith('mailto:') || href.startsWith('tel:') || a.target === '_blank') return;
    
    try {
      const url = new URL(href, location.href);
      if (url.host !== location.host) return;

      const currentIndex = getPathIndex(location.pathname);
      const targetIndex = getPathIndex(url.pathname);

      if (currentIndex === targetIndex && location.pathname === url.pathname) return;

      // Set target direction for the next page load
      if (targetIndex > currentIndex) {
        sessionStorage.setItem('slide_dir', 'right');
      } else {
        sessionStorage.setItem('slide_dir', 'left');
      }
    } catch (err) {}
  });
})();


/* ── Stat counter animation ── */
(function () {
  document.querySelectorAll('[data-count]').forEach(el => {
    const target = parseInt(el.dataset.count, 10);
    const io = new IntersectionObserver(([entry]) => {
      if (!entry.isIntersecting) return;
      io.unobserve(el);
      let start = 0;
      const step = () => {
        start = Math.min(start + Math.ceil(target / 40), target);
        el.textContent = start;
        if (start < target) requestAnimationFrame(step);
      };
      requestAnimationFrame(step);
    }, { threshold: 0.5 });
    io.observe(el);
  });
})();
</script>
</body>
</html>