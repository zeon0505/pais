@extends('layouts.app')

@section('content')
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-12 text-center max-w-4xl mx-auto my-12 slide-from-bottom">
  <div class="w-20 h-20 bg-teal-50 rounded-full flex items-center justify-center text-teal-600 mx-auto mb-6">
    <i class="fas fa-tools text-3xl"></i>
  </div>
  <h2 class="text-2xl font-bold text-gray-800 mb-4">Halaman Sedang Dalam Penyiapan</h2>
  <p class="text-gray-500 leading-relaxed max-w-xl mx-auto">
    Konten untuk halaman <strong>{{ $title }}</strong> sedang dipersiapkan oleh tim akademik. 
    Silakan kembali lagi nanti untuk melihat pembaruan informasi.
  </p>
  <div class="mt-8">
    <a href="{{ route('home') }}" class="inline-flex items-center gap-2 px-6 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-xl font-medium transition-colors">
      <i class="fas fa-arrow-left"></i> Kembali ke Beranda
    </a>
  </div>
</div>
@endsection