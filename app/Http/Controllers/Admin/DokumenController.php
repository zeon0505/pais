<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dokumen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DokumenController extends Controller
{
    public function index(Request $request)
    {
        $query = Dokumen::orderBy('kategori')->orderBy('urutan');
        
        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
        }

        $dokumens = $query->paginate(20);
        $kategoriList = Dokumen::getKategoriList();

        return view('admin.dokumens.index', compact('dokumens', 'kategoriList'));
    }

    public function create()
    {
        $kategoriList = Dokumen::getKategoriList();
        return view('admin.dokumens.form', compact('kategoriList'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul'      => 'required|string|max:255',
            'kategori'   => 'required|string',
            'file'       => 'required|file|mimes:pdf,doc,docx,xls,xlsx,zip,rar,png,jpg,jpeg|max:20480',
            'keterangan' => 'nullable|string',
            'urutan'     => 'nullable|integer',
            'aktif'      => 'nullable|boolean',
        ]);

        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('dokumens', 'public');
            $validated['file_path'] = $path;
        }

        $validated['aktif'] = $request->has('aktif');
        $validated['urutan'] = $request->urutan ?? 1;

        Dokumen::create($validated);

        return redirect()->route('admin.dokumens.index')->with('success', 'Dokumen berhasil ditambahkan.');
    }

    public function edit(Dokumen $dokumen)
    {
        $kategoriList = Dokumen::getKategoriList();
        return view('admin.dokumens.form', compact('dokumen', 'kategoriList'));
    }

    public function update(Request $request, Dokumen $dokumen)
    {
        $validated = $request->validate([
            'judul'      => 'required|string|max:255',
            'kategori'   => 'required|string',
            'file'       => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,zip,rar,png,jpg,jpeg|max:20480',
            'keterangan' => 'nullable|string',
            'urutan'     => 'nullable|integer',
            'aktif'      => 'nullable|boolean',
        ]);

        if ($request->hasFile('file')) {
            if ($dokumen->file_path && Storage::disk('public')->exists($dokumen->file_path)) {
                Storage::disk('public')->delete($dokumen->file_path);
            }
            $path = $request->file('file')->store('dokumens', 'public');
            $validated['file_path'] = $path;
        }

        $validated['aktif'] = $request->has('aktif');
        $validated['urutan'] = $request->urutan ?? 1;

        $dokumen->update($validated);

        return redirect()->route('admin.dokumens.index')->with('success', 'Dokumen berhasil diperbarui.');
    }

    public function destroy(Dokumen $dokumen)
    {
        if ($dokumen->file_path && Storage::disk('public')->exists($dokumen->file_path)) {
            Storage::disk('public')->delete($dokumen->file_path);
        }
        $dokumen->delete();

        return redirect()->route('admin.dokumens.index')->with('success', 'Dokumen berhasil dihapus.');
    }
}
