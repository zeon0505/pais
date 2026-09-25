@extends('layouts.admin')

@section('title', isset($dokumen) ? 'Edit Dokumen' : 'Tambah Dokumen')

@section('content')
<div style="max-width:700px; margin:0 auto;">
  <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:24px;">
    <div>
      <h1 style="font-size:22px; font-weight:800; color:#0f172a; margin:0;">{{ isset($dokumen) ? 'Edit Dokumen' : 'Tambah Dokumen Baru' }}</h1>
      <p style="font-size:13px; color:#64748b; margin:4px 0 0 0;">Isi formulir di bawah ini untuk mengunggah atau memperbarui dokumen.</p>
    </div>
    <a href="{{ route('admin.dokumens.index') }}" style="background:#f1f5f9; color:#334155; padding:10px 16px; border-radius:10px; font-weight:600; font-size:13px; text-decoration:none;">
      <i class="fas fa-arrow-left"></i> Kembali
    </a>
  </div>

  <div style="background:#fff; padding:32px; border-radius:16px; border:1px solid #e2e8f0; box-shadow:0 1px 3px rgba(0,0,0,0.05);">
    <form action="{{ isset($dokumen) ? route('admin.dokumens.update', $dokumen) : route('admin.dokumens.store') }}" method="POST" enctype="multipart/form-data">
      @csrf
      @if(isset($dokumen))
        @method('PUT')
      @endif

      <!-- Judul -->
      <div style="margin-bottom:20px;">
        <label style="display:block; font-size:13px; font-weight:700; color:#0f172a; margin-bottom:6px;">Judul Dokumen <span style="color:#ef4444;">*</span></label>
        <input type="text" name="judul" value="{{ old('judul', $dokumen->judul ?? '') }}" required style="width:100%; padding:10px 14px; border-radius:10px; border:1px solid #cbd5e1; font-size:14px;" placeholder="Contoh: Dokumen Pendukung Kriteria 1 - Visi Misi">
        @error('judul') <span style="color:#ef4444; font-size:12px;">{{ $message }}</span> @enderror
      </div>

      <!-- Kategori -->
      <div style="margin-bottom:20px;">
        <label style="display:block; font-size:13px; font-weight:700; color:#0f172a; margin-bottom:6px;">Kategori Dokumen <span style="color:#ef4444;">*</span></label>
        <select name="kategori" required style="width:100%; padding:10px 14px; border-radius:10px; border:1px solid #cbd5e1; font-size:14px; background:#fff;">
          <option value="">-- Pilih Kategori --</option>
          @foreach($kategoriList as $key => $label)
            <option value="{{ $key }}" {{ old('kategori', $dokumen->kategori ?? '') == $key ? 'selected' : '' }}>{{ $label }}</option>
          @endforeach
        </select>
        @error('kategori') <span style="color:#ef4444; font-size:12px;">{{ $message }}</span> @enderror
      </div>

      <!-- File -->
      <div style="margin-bottom:20px;">
        <label style="display:block; font-size:13px; font-weight:700; color:#0f172a; margin-bottom:6px;">File Dokumen {{ isset($dokumen) ? '(Biarkan kosong jika tidak diubah)' : '*' }}</label>
        <input type="file" name="file" {{ isset($dokumen) ? '' : 'required' }} style="width:100%; padding:8px; border-radius:10px; border:1px solid #cbd5e1; font-size:13px;">
        <p style="font-size:11px; color:#64748b; margin:4px 0 0 0;">Format yang didukung: PDF, DOC, DOCX, XLS, XLSX, ZIP, RAR, PNG, JPG (Maks: 20MB)</p>
        @if(isset($dokumen) && $dokumen->file_path)
          <div style="margin-top:8px; font-size:12px;">
            File saat ini: <a href="{{ asset('storage/' . $dokumen->file_path) }}" target="_blank" style="color:#074e50; font-weight:700;">Lihat File</a>
          </div>
        @endif
        @error('file') <span style="color:#ef4444; font-size:12px;">{{ $message }}</span> @enderror
      </div>

      <!-- Keterangan -->
      <div style="margin-bottom:20px;">
        <label style="display:block; font-size:13px; font-weight:700; color:#0f172a; margin-bottom:6px;">Keterangan / Deskripsi (Opsional)</label>
        <textarea name="keterangan" rows="3" style="width:100%; padding:10px 14px; border-radius:10px; border:1px solid #cbd5e1; font-size:14px;" placeholder="Penjelasan singkat mengenai dokumen...">{{ old('keterangan', $dokumen->keterangan ?? '') }}</textarea>
      </div>

      <!-- Urutan & Aktif -->
      <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px; margin-bottom:24px;">
        <div>
          <label style="display:block; font-size:13px; font-weight:700; color:#0f172a; margin-bottom:6px;">Urutan Tampil</label>
          <input type="number" name="urutan" value="{{ old('urutan', $dokumen->urutan ?? 1) }}" style="width:100%; padding:10px 14px; border-radius:10px; border:1px solid #cbd5e1; font-size:14px;">
        </div>
        <div style="display:flex; align-items:center; margin-top:24px;">
          <label style="display:flex; align-items:center; gap:8px; font-size:14px; font-weight:600; cursor:pointer;">
            <input type="checkbox" name="aktif" value="1" {{ old('aktif', $dokumen->aktif ?? true) ? 'checked' : '' }} style="width:18px; height:18px;">
            <span>Aktif (Tampilkan di Website)</span>
          </label>
        </div>
      </div>

      <div style="display:flex; justify-content:flex-end; gap:12px; border-top:1px solid #e2e8f0; padding-top:20px;">
        <a href="{{ route('admin.dokumens.index') }}" style="background:#f1f5f9; color:#334155; padding:10px 20px; border-radius:10px; font-weight:700; font-size:14px; text-decoration:none;">Batal</a>
        <button type="submit" style="background:#074e50; color:#fff; padding:10px 24px; border-radius:10px; font-weight:700; font-size:14px; border:none; cursor:pointer;">
          Simpan Dokumen
        </button>
      </div>
    </form>
  </div>
</div>
@endsection
