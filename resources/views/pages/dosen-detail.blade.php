@extends('layouts.app')

@section('header')
<div class="h-40 bg-teal-800 bg-blend-multiply bg-center bg-cover" style="background-image: url('{{ asset('images/bg-hero.jpg') }}')">
  <div class="h-full container mx-auto flex items-center">
    <div>
      <h1 class="text-2xl md:text-3xl text-white font-bold">{{ $title }}</h1>
      <p class="text-sm text-teal-200">{{ $subtitle }}</p>
    </div>
  </div>
</div>
@endsection

@section('content')
<div class="bg-white rounded-2xl shadow-sm -mt-16">
  <div class="p-4 md:p-6">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
      <div class="col-span-1">
        <div class="aspect-[3/4] rounded-xl overflow-hidden">
          @if($dosen->foto)
          <img src="{{ str_starts_with($dosen->foto, 'http') ? $dosen->foto : asset('storage/' . $dosen->foto) }}" alt="{{ $dosen->nama }}" class="w-full h-full object-cover">
          @else
          <div class="w-full h-full bg-teal-100 flex items-center justify-center">
            <i class="fas fa-user text-teal-400 text-3xl"></i>
          </div>
          @endif
        </div>
      </div>
      <div class="col-span-1 md:col-span-2">
        <div class="divide-y divide-gray-100">
          <div class="py-3">
            <h5 class="text-xs text-gray-400">Nama</h5>
            <p class="text-sm font-semibold text-gray-800">{{ $dosen->nama_lengkap }}</p>
          </div>
          <div class="py-3">
            <h5 class="text-xs text-gray-400">Jabatan</h5>
            <p class="text-sm font-semibold text-gray-800">{{ $dosen->jabatan_akademik ?? $dosen->jabatan }}</p>
          </div>
          <div class="py-3">
            <h5 class="text-xs text-gray-400">Program Studi</h5>
            @if($dosen->program_studi)
              <p class="text-sm font-semibold text-gray-800">{{ $dosen->program_studi }}</p>
            @else
              <p class="text-sm text-gray-800">-</p>
            @endif
          </div>
          <div class="py-3">
            <h5 class="text-xs text-gray-400">Jenis Pegawai / Status</h5>
            @if($dosen->status)
              <p class="text-sm font-semibold text-gray-800">{{ $dosen->status }}</p>
            @else
              <p class="text-sm text-gray-800">-</p>
            @endif
          </div>
          <div class="py-3">
            <h5 class="text-xs text-gray-400">NIDN</h5>
            @if($dosen->nidn)
              <p class="text-sm font-semibold text-gray-800">{{ $dosen->nidn }}</p>
            @else
              <p class="text-sm text-gray-800">-</p>
            @endif
          </div>
          <div class="py-3">
            <h5 class="text-xs text-gray-400">NUPTK</h5>
            @if($dosen->nuptk)
              <p class="text-sm font-semibold text-gray-800">{{ $dosen->nuptk }}</p>
            @else
              <p class="text-sm text-gray-800">-</p>
            @endif
          </div>
          <div class="py-3">
            <h5 class="text-xs text-gray-400">Google Scholar</h5>
            @if($dosen->google_scholar)
            <a href="{{ $dosen->google_scholar }}" target="_blank" class="text-sm font-semibold text-teal-700 hover:underline">Klik disini</a>
            @else
            <p class="text-sm text-gray-800">-</p>
            @endif
          </div>
          <div class="py-3">
            <h5 class="text-xs text-gray-400">Email</h5>
            @if($dosen->email)
              <p class="text-sm font-semibold text-gray-800">{{ $dosen->email }}</p>
            @else
              <p class="text-sm text-gray-800">-</p>
            @endif
          </div>
          <div class="py-3">
            <h5 class="text-xs text-gray-400">Pendidikan Terakhir</h5>
            @if($dosen->pendidikan_terakhir)
              <p class="text-sm font-semibold text-gray-800">{{ $dosen->pendidikan_terakhir }}</p>
            @else
              <p class="text-sm text-gray-800">-</p>
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection