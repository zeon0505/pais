@extends('layouts.app')

@section('content')
<div class="space-y-10 max-w-6xl mx-auto py-4">

  <!-- HERO BANNER DOKUMEN LAMDIK -->
  <div class="bg-gradient-to-br from-teal-800 to-teal-900 rounded-3xl p-8 sm:p-10 text-white shadow-xl relative overflow-hidden">
    <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_right,rgba(201,168,76,0.15),transparent_60%)]"></div>
    <div class="relative z-10 max-w-3xl space-y-3">
      <span class="inline-block bg-yellow-500/20 text-yellow-300 border border-yellow-500/30 px-3.5 py-1 rounded-full text-xs font-bold uppercase tracking-wider">
        <i class="fas fa-shield-alt mr-1"></i> Akreditasi LAMDIK
      </span>
      <h1 class="text-2xl sm:text-3xl font-black leading-tight">Dokumen Pendukung 9 Kriteria LAMDIK</h1>
      <p class="text-teal-100 text-sm leading-relaxed">
        Pusat repositori dokumen pendukung borang akreditasi Lembaga Akreditasi Mandiri Kependidikan (LAMDIK) Program Studi Pendidikan Agama Islam (PAI) STAIMAS Wonogiri.
      </p>
    </div>
  </div>

  <!-- GRID 9 KRITERIA LAMDIK -->
  <div class="space-y-6">
    @foreach($kriteriaList as $key => $info)
      @php
        $items = $dokumens[$key] ?? collect();
      @endphp
      <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden transition-all hover:shadow-md">
        <!-- Header Kriteria -->
        <div class="bg-slate-50 px-6 py-4 border-b border-gray-100 flex items-center justify-between gap-4">
          <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl bg-teal-700 text-white flex items-center justify-center shrink-0 shadow-sm">
              <i class="{{ $info['icon'] }} text-base"></i>
            </div>
            <div>
              <h3 class="font-bold text-gray-800 text-base">{{ $info['title'] }}</h3>
              <p class="text-xs text-gray-500">{{ $items->count() }} Dokumen Pendukung Tersedia</p>
            </div>
          </div>
          <span class="text-xs font-semibold px-2.5 py-1 rounded-full {{ $items->count() > 0 ? 'bg-emerald-50 text-emerald-700 border border-emerald-200' : 'bg-gray-100 text-gray-500' }}">
            {{ $items->count() > 0 ? 'Tersedia' : 'Belum Ada File' }}
          </span>
        </div>

        <!-- Body / Items Dokumen -->
        <div class="p-6">
          @if($items->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
              @foreach($items as $doc)
                <div class="p-4 rounded-xl border border-gray-100 bg-gray-50/50 hover:bg-white hover:border-teal-200 hover:shadow-sm transition-all flex items-start justify-between gap-4">
                  <div class="space-y-1">
                    <h4 class="font-bold text-gray-800 text-sm leading-snug">{{ $doc->judul }}</h4>
                    @if($doc->keterangan)
                      <p class="text-xs text-gray-500 line-clamp-2">{{ $doc->keterangan }}</p>
                    @endif
                    <div class="text-[11px] text-gray-400 pt-1">
                      <i class="far fa-clock mr-1"></i> {{ $doc->created_at->isoFormat('D MMMM Y') }}
                    </div>
                  </div>
                  <a href="{{ asset('storage/' . $doc->file_path) }}" download target="_blank" class="inline-flex items-center gap-1.5 px-3.5 py-2 bg-teal-700 hover:bg-teal-800 text-white text-xs font-bold rounded-lg shrink-0 shadow-sm transition-colors">
                    <i class="fas fa-download"></i> Unduh
                  </a>
                </div>
              @endforeach
            </div>
          @else
            <div class="text-center py-6 text-gray-400 text-xs italic bg-gray-50/30 rounded-xl border border-dashed border-gray-200">
              <i class="fas fa-folder-open text-xl block mb-1 text-gray-300"></i>
              Dokumen pendukung untuk kriteria ini belum diunggah oleh admin.
            </div>
          @endif
        </div>
      </div>
    @endforeach
  </div>

</div>
@endsection
