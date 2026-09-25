@extends('layouts.app')

@section('content')
<div class="space-y-12 max-w-6xl mx-auto py-4">

  <!-- HERO BANNER PMB -->
  <div class="bg-gradient-to-br from-teal-800 via-teal-900 to-slate-900 rounded-3xl p-8 sm:p-12 text-white shadow-xl relative overflow-hidden">
    <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_right,rgba(234,179,8,0.2),transparent_60%)]"></div>
    <div class="relative z-10 max-w-3xl space-y-4">
      <span class="inline-block bg-yellow-500 text-gray-950 px-3.5 py-1 rounded-full text-xs font-black uppercase tracking-wider shadow-sm">
        <i class="fas fa-graduation-cap mr-1"></i> Penerimaan Mahasiswa Baru 2026/2027
      </span>
      <h1 class="text-3xl sm:text-4xl font-black leading-tight">Bergabunglah Bersama Program Studi S1 PAI STAIMAS Wonogiri</h1>
      <p class="text-teal-100 text-sm sm:text-base leading-relaxed">
        Mencetak Sarjana Pendidikan Agama Islam yang unggul, profesional, dan berjiwa edupreneurship berbasis nilai-nilai keislaman dan religius kekaryaan.
      </p>

      <div class="pt-2 flex flex-wrap gap-4">
        <a href="https://staimaswonogiri.ecampuz.com/eadmisi/" target="_blank" class="bg-yellow-500 hover:bg-yellow-600 text-gray-950 font-extrabold px-6 py-3.5 rounded-xl text-sm transition-all shadow-lg shadow-yellow-500/20 flex items-center gap-2">
          <i class="fas fa-user-plus"></i> Daftar PMB Online Sekarang
        </a>
        <a href="https://wa.me/6282223204552" target="_blank" class="bg-white/10 hover:bg-white/20 text-white border border-white/20 font-bold px-6 py-3.5 rounded-xl text-sm transition-all flex items-center gap-2">
          <i class="fab fa-whatsapp text-emerald-400 text-base"></i> Konsultasi PMB (WhatsApp)
        </a>
      </div>
    </div>
  </div>

  <!-- INFORMASI ALUR & SYARAT PMB -->
  <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm space-y-3">
      <div class="w-12 h-12 bg-teal-50 text-teal-700 rounded-xl flex items-center justify-center font-bold text-lg">1</div>
      <h3 class="font-bold text-gray-800 text-base">Pendaftaran Online</h3>
      <p class="text-xs text-gray-600 leading-relaxed">Isi formulir pendaftaran secara online melalui portal eAdmisi STAIMAS Wonogiri atau secara langsung di kampus.</p>
    </div>
    <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm space-y-3">
      <div class="w-12 h-12 bg-teal-50 text-teal-700 rounded-xl flex items-center justify-center font-bold text-lg">2</div>
      <h3 class="font-bold text-gray-800 text-base">Upload Berkas</h3>
      <p class="text-xs text-gray-600 leading-relaxed">Unggah fotokopi ijazah/SKL, KTP/Kartu Keluarga, pasfoto terbaru, serta dokumen pendukung prestasi jika ada.</p>
    </div>
    <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm space-y-3">
      <div class="w-12 h-12 bg-teal-50 text-teal-700 rounded-xl flex items-center justify-center font-bold text-lg">3</div>
      <h3 class="font-bold text-gray-800 text-base">Seleksi & Registrasi</h3>
      <p class="text-xs text-gray-600 leading-relaxed">Pengumuman kelulusan seleksi berkas/tes, dilanjutkan registrasi ulang untuk menjadi mahasiswa resmi PAI STAIMAS.</p>
    </div>
  </div>

  <!-- POSTER BROSUR PMB DARI ADMIN -->
  @if($posters->count() > 0)
    <div class="space-y-6">
      <h2 class="text-xl font-bold text-gray-800 flex items-center gap-2">
        <i class="fas fa-bullhorn text-yellow-600"></i> Brosur & Poster Resmi PMB
      </h2>

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($posters as $p)
          <div class="bg-white rounded-2xl border border-gray-100 overflow-hidden shadow-sm hover:shadow-md transition-all p-4 space-y-3">
            @if($p->gambar)
              <div class="rounded-xl overflow-hidden bg-gray-50 h-72 flex items-center justify-center">
                @php
                  $posterImg = str_starts_with($p->gambar, 'http') ? $p->gambar : asset('storage/' . $p->gambar);
                @endphp
                <img src="{{ $posterImg }}" alt="{{ $p->judul }}" class="max-h-full w-auto object-contain">
              </div>
            @endif
            <div>
              <h4 class="font-bold text-gray-800 text-sm">{{ $p->judul }}</h4>
              @if($p->deskripsi)
                <p class="text-xs text-gray-500 mt-1">{{ $p->deskripsi }}</p>
              @endif
            </div>
            @if($p->gambar)
              <a href="{{ $posterImg }}" target="_blank" class="inline-flex items-center gap-1.5 text-xs font-bold text-teal-700 hover:underline pt-1">
                <i class="fas fa-search-plus"></i> Lihat Poster Ukuran Penuh
              </a>
            @endif
          </div>
        @endforeach
      </div>
    </div>
  @endif

  <!-- BERITA / RILIS PENGUMUMAN PMB -->
  @if($beritas->count() > 0)
    <div class="space-y-6">
      <h2 class="text-xl font-bold text-gray-800 flex items-center gap-2">
        <i class="fas fa-newspaper text-teal-600"></i> Informasi & Pengumuman PMB Terbaru
      </h2>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @foreach($beritas as $b)
          <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm flex flex-col justify-between space-y-4">
            <div class="space-y-2">
              <div class="text-xs text-gray-400 flex items-center gap-1.5">
                <i class="far fa-calendar-alt"></i> {{ \Carbon\Carbon::parse($b->tanggal)->isoFormat('D MMMM Y') }}
              </div>
              <h3 class="font-bold text-gray-800 text-base hover:text-teal-700">
                <a href="{{ route('pages.berita.show', $b->slug) }}">{{ $b->judul }}</a>
              </h3>
              <p class="text-xs text-gray-600 line-clamp-3 leading-relaxed">
                {{ Str::limit(strip_tags($b->konten), 140) }}
              </p>
            </div>
            <a href="{{ route('pages.berita.show', $b->slug) }}" class="text-xs font-bold text-teal-700 hover:text-teal-900 flex items-center gap-1">
              Baca Pengumuman Lengkap <i class="fas fa-arrow-right text-[10px]"></i>
            </a>
          </div>
        @endforeach
      </div>
    </div>
  @endif

</div>
@endsection
