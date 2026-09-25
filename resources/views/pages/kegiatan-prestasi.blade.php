@extends('layouts.app')

@section('content')
<div class="space-y-12 max-w-6xl mx-auto py-4">

  <!-- HERO BANNER -->
  <div class="bg-gradient-to-br from-teal-800 to-teal-900 rounded-3xl p-8 sm:p-10 text-white shadow-xl relative overflow-hidden">
    <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_right,rgba(201,168,76,0.15),transparent_60%)]"></div>
    <div class="relative z-10 max-w-3xl space-y-3">
      <span class="inline-block bg-yellow-500/20 text-yellow-300 border border-yellow-500/30 px-3.5 py-1 rounded-full text-xs font-bold uppercase tracking-wider">
        <i class="fas fa-trophy mr-1"></i> Kemahasiswaan & Prestasi
      </span>
      <h1 class="text-2xl sm:text-3xl font-black leading-tight">Kegiatan & Prestasi Mahasiswa PAI</h1>
      <p class="text-teal-100 text-sm leading-relaxed">
        Dokumentasi kebanggaan, rilis berita kegiatan kemahasiswaan, kompetisi keislaman, poster pengumuman, dan capaian prestasi akademik maupun non-akademik mahasiswa Prodi PAI STAIMAS Wonogiri.
      </p>
    </div>
  </div>

  <!-- BERITA & PRESTASI GRID -->
  <div class="space-y-6">
    <div class="flex items-center justify-between border-b border-gray-200 pb-4">
      <h2 class="text-xl font-bold text-gray-800 flex items-center gap-2">
        <i class="fas fa-newspaper text-teal-600"></i> Berita Kegiatan & Prestasi Terbaru
      </h2>
    </div>

    @if($beritas->count() > 0)
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($beritas as $b)
          <div class="bg-white rounded-2xl border border-gray-100 overflow-hidden shadow-sm hover:shadow-lg transition-all flex flex-col group">
            @if($b->gambar)
              <div class="h-48 overflow-hidden bg-gray-100 relative">
                @php
                  $imgUrl = str_starts_with($b->gambar, 'http') ? $b->gambar : asset('storage/' . $b->gambar);
                @endphp
                <img src="{{ $imgUrl }}" alt="{{ $b->judul }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                <span class="absolute top-3 left-3 bg-teal-700/90 backdrop-blur-sm text-white text-[10px] font-bold px-2.5 py-1 rounded-md uppercase tracking-wider">
                  {{ $b->kategori->nama ?? 'Kegiatan' }}
                </span>
              </div>
            @else
              <div class="h-48 bg-gradient-to-br from-teal-700 to-teal-900 flex items-center justify-center p-6 text-white text-center relative">
                <i class="fas fa-award text-5xl opacity-20"></i>
                <span class="absolute top-3 left-3 bg-yellow-500 text-gray-950 text-[10px] font-extrabold px-2.5 py-1 rounded-md uppercase tracking-wider">
                  {{ $b->kategori->nama ?? 'Prestasi' }}
                </span>
              </div>
            @endif

            <div class="p-5 flex-1 flex flex-col justify-between space-y-4">
              <div class="space-y-2">
                <div class="text-xs text-gray-400 flex items-center gap-1.5">
                  <i class="far fa-calendar-alt"></i>
                  <span>{{ \Carbon\Carbon::parse($b->tanggal)->isoFormat('D MMMM Y') }}</span>
                </div>
                <h3 class="font-bold text-gray-800 text-base group-hover:text-teal-700 transition-colors line-clamp-2">
                  <a href="{{ route('pages.berita.show', $b->slug) }}">{{ $b->judul }}</a>
                </h3>
                <p class="text-xs text-gray-600 line-clamp-3 leading-relaxed">
                  {{ Str::limit(strip_tags($b->konten), 120) }}
                </p>
              </div>

              <div class="pt-3 border-t border-gray-100 flex items-center justify-between">
                <a href="{{ route('pages.berita.show', $b->slug) }}" class="text-xs font-bold text-teal-700 hover:text-teal-900 flex items-center gap-1">
                  Baca Selengkapnya <i class="fas fa-arrow-right text-[10px]"></i>
                </a>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    @else
      <div class="text-center py-12 bg-white rounded-2xl border border-gray-100 p-8 text-gray-500">
        <i class="fas fa-info-circle text-3xl text-gray-300 mb-2"></i>
        <p class="text-sm font-medium">Belum ada berita kegiatan atau prestasi yang diunggah.</p>
      </div>
    @endif
  </div>

  <!-- POSTER & PENGUMUMAN KEMAHASISWAAN -->
  @if($posters->count() > 0)
    <div class="space-y-6 pt-4">
      <div class="flex items-center justify-between border-b border-gray-200 pb-4">
        <h2 class="text-xl font-bold text-gray-800 flex items-center gap-2">
          <i class="fas fa-images text-yellow-600"></i> Poster & Banner Pengumuman
        </h2>
      </div>

      <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
        @foreach($posters as $p)
          <div class="bg-white rounded-2xl border border-gray-100 overflow-hidden shadow-sm hover:shadow-md transition-all p-4 space-y-3">
            @if($p->gambar)
              <div class="rounded-xl overflow-hidden bg-gray-50 h-56 flex items-center justify-center">
                @php
                  $posterImg = str_starts_with($p->gambar, 'http') ? $p->gambar : asset('storage/' . $p->gambar);
                @endphp
                <img src="{{ $posterImg }}" alt="{{ $p->judul }}" class="max-h-full w-auto object-contain">
              </div>
            @endif
            <div>
              <span class="text-[10px] font-bold text-teal-700 bg-teal-50 px-2 py-0.5 rounded uppercase">{{ $p->kategori ?? 'Pengumuman' }}</span>
              <h4 class="font-bold text-gray-800 text-sm mt-1">{{ $p->judul }}</h4>
              @if($p->deskripsi)
                <p class="text-xs text-gray-500 mt-1 line-clamp-2">{{ $p->deskripsi }}</p>
              @endif
            </div>
            <a href="{{ route('pages.pengumuman.show', $p->slug ?? $p->id) }}" class="inline-flex items-center gap-1 text-xs font-bold text-teal-700 hover:underline pt-2">
              <i class="fas fa-eye"></i> Lihat Detail Poster
            </a>
          </div>
        @endforeach
      </div>
    </div>
  @endif

</div>
@endsection
