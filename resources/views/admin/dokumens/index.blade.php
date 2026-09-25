@extends('layouts.admin')

@section('title', 'Kelola Dokumen')

@section('content')
<div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:24px;">
  <div>
    <h1 style="font-size:22px; font-weight:800; color:#0f172a; margin:0;">Kelola Dokumen & Akreditasi</h1>
    <p style="font-size:13px; color:#64748b; margin:4px 0 0 0;">Kelola dokumen akreditasi 9 Kriteria LAMDIK, RPS, Kalender Akademik, dan berkas akademik lainnya.</p>
  </div>
  <a href="{{ route('admin.dokumens.create') }}" style="background:#074e50; color:#fff; padding:10px 18px; border-radius:10px; font-weight:700; font-size:13px; text-decoration:none; display:inline-flex; align-items:center; gap:8px;">
    <i class="fas fa-plus"></i> Tambah Dokumen
  </a>
</div>

<!-- Filter Kategori -->
<div style="background:#fff; padding:16px; border-radius:12px; margin-bottom:20px; border:1px solid #e2e8f0;">
  <form method="GET" action="{{ route('admin.dokumens.index') }}" style="display:flex; gap:12px; align-items:center; flex-wrap:wrap;">
    <label style="font-size:13px; font-weight:600; color:#334155;">Filter Kategori:</label>
    <select name="kategori" onchange="this.form.submit()" style="padding:8px 14px; border-radius:8px; border:1px solid #cbd5e1; font-size:13px; background:#fff; min-width:280px;">
      <option value="">-- Semua Kategori --</option>
      @foreach($kategoriList as $key => $label)
        <option value="{{ $key }}" {{ request('kategori') == $key ? 'selected' : '' }}>{{ $label }}</option>
      @endforeach
    </select>
    @if(request('kategori'))
      <a href="{{ route('admin.dokumens.index') }}" style="font-size:12px; color:#ef4444; text-decoration:underline;">Reset Filter</a>
    @endif
  </form>
</div>

<!-- Table -->
<div style="background:#fff; border-radius:16px; border:1px solid #e2e8f0; overflow:hidden; box-shadow:0 1px 3px rgba(0,0,0,0.05);">
  <table style="width:100%; border-collapse:collapse; text-align:left; font-size:13px;">
    <thead>
      <tr style="background:#f8fafc; border-bottom:1px solid #e2e8f0; color:#475569; font-weight:700; text-transform:uppercase; font-size:11px; letter-spacing:0.05em;">
        <th style="padding:14px 20px;">No</th>
        <th style="padding:14px 20px;">Judul Dokumen</th>
        <th style="padding:14px 20px;">Kategori</th>
        <th style="padding:14px 20px;">File</th>
        <th style="padding:14px 20px;">Status</th>
        <th style="padding:14px 20px; text-align:right;">Aksi</th>
      </tr>
    </thead>
    <tbody style="color:#334155;">
      @forelse($dokumens as $index => $doc)
      <tr style="border-bottom:1px solid #f1f5f9;">
        <td style="padding:14px 20px; color:#64748b; font-weight:600;">{{ $dokumens->firstItem() + $index }}</td>
        <td style="padding:14px 20px; font-weight:700; color:#0f172a;">
          {{ $doc->judul }}
          @if($doc->keterangan)
            <div style="font-size:11px; color:#64748b; font-weight:400; margin-top:2px;">{{ Str::limit($doc->keterangan, 60) }}</div>
          @endif
        </td>
        <td style="padding:14px 20px;">
          <span style="background:#e0f2fe; color:#0369a1; padding:3px 8px; border-radius:6px; font-size:11px; font-weight:700;">
            {{ $kategoriList[$doc->kategori] ?? $doc->kategori }}
          </span>
        </td>
        <td style="padding:14px 20px;">
          <a href="{{ asset('storage/' . $doc->file_path) }}" target="_blank" style="color:#074e50; font-weight:700; text-decoration:none; display:inline-flex; align-items:center; gap:4px;">
            <i class="fas fa-file-download"></i> Unduh File
          </a>
        </td>
        <td style="padding:14px 20px;">
          @if($doc->aktif)
            <span style="background:#f0fdf4; color:#166534; padding:3px 8px; border-radius:6px; font-size:11px; font-weight:700;">Aktif</span>
          @else
            <span style="background:#fef2f2; color:#991b1b; padding:3px 8px; border-radius:6px; font-size:11px; font-weight:700;">Nonaktif</span>
          @endif
        </td>
        <td style="padding:14px 20px; text-align:right;">
          <div style="display:flex; gap:8px; justify-content:flex-end;">
            <a href="{{ route('admin.dokumens.edit', $doc) }}" style="background:#f1f5f9; color:#334155; width:32px; height:32px; border-radius:8px; display:inline-flex; align-items:center; justify-content:center; text-decoration:none;">
              <i class="fas fa-edit"></i>
            </a>
            <form action="{{ route('admin.dokumens.destroy', $doc) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus dokumen ini?')">
              @csrf
              @method('DELETE')
              <button type="submit" style="background:#fef2f2; color:#ef4444; width:32px; height:32px; border-radius:8px; border:none; cursor:pointer; display:inline-flex; align-items:center; justify-content:center;">
                <i class="fas fa-trash"></i>
              </button>
            </form>
          </div>
        </td>
      </tr>
      @empty
      <tr>
        <td colspan="6" style="padding:40px; text-align:center; color:#94a3b8;">
          Belum ada dokumen yang diunggah. <a href="{{ route('admin.dokumens.create') }}" style="color:#074e50; font-weight:700;">Tambah Dokumen Baru</a>
        </td>
      </tr>
      @endforelse
    </tbody>
  </table>
  @if($dokumens->hasPages())
    <div style="padding:16px 20px; border-top:1px solid #e2e8f0;">
      {{ $dokumens->links() }}
    </div>
  @endif
</div>
@endsection
