<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dosen;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class DosenController extends Controller
{
    public function index()
    {
        return view('admin.dosens.index', ['dosens' => Dosen::orderBy('urutan')->get()]);
    }

    public function create()
    {
        return view('admin.dosens.form', ['dosen' => null]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'    => 'required|string|max:255',
            'email'   => 'nullable|email|max:255|unique:dosens,email',
            'nidn'    => 'nullable|string|max:255|unique:dosens,nidn',
            'foto'    => 'nullable|image|max:3072',
        ]);

        $data = $request->only('nama', 'gelar_depan', 'gelar_belakang', 'jabatan', 'program_studi', 'urutan', 'nidn', 'nuptk', 'jabatan_akademik', 'status', 'email', 'google_scholar', 'pendidikan_terakhir');
        $data['aktif'] = $request->boolean('aktif', true);
        
        $namaLengkap = trim(($request->gelar_depan ?? '') . ' ' . $request->nama . ' ' . ($request->gelar_belakang ?? ''));
        $data['slug'] = Str::slug($namaLengkap);

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('dosens', 'public');
        } elseif ($request->filled('foto_url')) {
            $data['foto'] = $request->foto_url;
        }

        Dosen::create($data);
        return redirect()->route('admin.dosens.index')->with('success', 'Dosen berhasil ditambahkan.');
    }

    public function edit(Dosen $dosen)
    {
        return view('admin.dosens.form', compact('dosen'));
    }

    public function update(Request $request, Dosen $dosen)
    {
        $request->validate([
            'nama'    => 'required|string|max:255',
            'email'   => 'nullable|email|max:255|unique:dosens,email,' . $dosen->id,
            'nidn'    => 'nullable|string|max:255|unique:dosens,nidn,' . $dosen->id,
            'foto'    => 'nullable|image|max:3072',
        ]);

        $data = $request->only('nama', 'gelar_depan', 'gelar_belakang', 'jabatan', 'program_studi', 'urutan', 'nidn', 'nuptk', 'jabatan_akademik', 'status', 'email', 'google_scholar', 'pendidikan_terakhir');
        $data['aktif'] = $request->boolean('aktif');

        $namaLengkap = trim(($request->gelar_depan ?? '') . ' ' . $request->nama . ' ' . ($request->gelar_belakang ?? ''));
        $data['slug'] = Str::slug($namaLengkap);

        if ($request->hasFile('foto')) {
            if ($dosen->foto && !str_starts_with($dosen->foto, 'http')) {
                Storage::disk('public')->delete($dosen->foto);
            }
            $data['foto'] = $request->file('foto')->store('dosens', 'public');
        } elseif ($request->filled('foto_url')) {
            $data['foto'] = $request->foto_url;
        }

        $dosen->update($data);
        return redirect()->route('admin.dosens.index')->with('success', 'Data dosen berhasil diperbarui.');
    }

    public function destroy(Dosen $dosen)
    {
        if ($dosen->foto && !str_starts_with($dosen->foto, 'http')) {
            Storage::disk('public')->delete($dosen->foto);
        }
        $dosen->delete();
        return back()->with('success', 'Dosen berhasil dihapus.');
    }
}