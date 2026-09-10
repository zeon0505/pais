<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slide;
use App\Models\Berita;
use App\Models\Dosen;
use App\Models\Poster;
use App\Models\Kategori;

class PageController extends Controller
{
    public function home()
    {
        return view('welcome', [
            'slides'  => Slide::where('aktif', true)->orderBy('urutan')->get(),
            'beritas' => Berita::with('kategori')->where('aktif', true)->latest('tanggal')->take(3)->get(),
            'dosens'  => Dosen::where('aktif', true)->orderBy('urutan')->take(4)->get(),
        ]);
    }

    public function visiMisi()
    {
        return view('pages.visi-misi', [
            'title'    => 'Visi & Misi PAI',
            'subtitle' => 'Visi Keilmuan, Misi, Tujuan, dan Strategi Program Studi S1 PAI STAIMAS Wonogiri',
        ]);
    }

    public function dosen()
    {
        return view('pages.dosen', [
            'title'    => 'Dosen Pengajar PAI',
            'subtitle' => 'Profil dosen pengajar dan pembimbing akademik Program Studi PAI',
            'dosens'   => Dosen::where('aktif', true)->orderBy('urutan')->get(),
        ]);
    }

    public function dosenShow($slug)
    {
        $dosen = Dosen::where('slug', $slug)->where('aktif', true)->firstOrFail();

        return view('pages.dosen-detail', [
            'title'    => $dosen->nama,
            'subtitle' => 'Profil Lengkap Dosen',
            'dosen'    => $dosen,
        ]);
    }

    public function kurikulum()
    {
        return view('pages.kurikulum', [
            'title'    => 'Kurikulum PAI',
            'subtitle' => 'Struktur mata kuliah dan kurikulum akademik Program Studi S1 PAI',
        ]);
    }

    public function berita(Request $request)
    {
        $query = Berita::with('kategori')->where('aktif', true)->latest('tanggal');

        if ($request->filled('kategori')) {
            $query->whereHas('kategori', fn($q) => $q->where('slug', $request->kategori));
        }

        return view('pages.berita', [
            'title'     => 'Berita & Kegiatan PAI',
            'subtitle'  => 'Kumpulan berita terbaru, rilis pers, dan artikel ilmiah prodi PAI',
            'beritas'   => $query->get(),
            'kategoris' => Kategori::withCount('beritas')->get(),
            'posters'   => Poster::where('aktif', true)->latest()->get(),
        ]);
    }

    public function beritaShow($slug)
    {
        $berita = Berita::with('kategori')->where('slug', $slug)->where('aktif', true)->firstOrFail();

        $related = Berita::with('kategori')
            ->where('aktif', true)
            ->where('id', '!=', $berita->id)
            ->when($berita->kategori_id, fn($q) => $q->where('kategori_id', $berita->kategori_id))
            ->latest('tanggal')
            ->take(2)
            ->get();

        $prev = Berita::where('aktif', true)
            ->where('tanggal', '<', $berita->tanggal)
            ->orderBy('tanggal', 'desc')
            ->first();

        $next = Berita::where('aktif', true)
            ->where('tanggal', '>', $berita->tanggal)
            ->orderBy('tanggal', 'asc')
            ->first();

        $otherBeritas = Berita::where('aktif', true)
            ->where('id', '!=', $berita->id)
            ->latest('tanggal')
            ->take(5)
            ->get();

        return view('pages.berita-detail', [
            'title'    => $berita->judul,
            'subtitle' => 'Diterbitkan pada ' . \Carbon\Carbon::parse($berita->tanggal)->isoFormat('D MMMM Y'),
            'berita'   => $berita,
            'related'  => $related,
            'prev'     => $prev,
            'next'     => $next,
            'otherBeritas' => $otherBeritas,
        ]);
    }

    public function pengumuman()
    {
        return view('pages.pengumuman', [
            'title' => 'Poster & Pengumuman PAI',
            'subtitle' => 'Pengumuman resmi, poster informasi, dan kegiatan dari Prodi PAI STAIMAS Wonogiri',
            'posters' => \App\Models\Poster::where('aktif', true)->latest()->get(),
        ]);
    }

    public function pengumumanShow($key)
    {
        $poster = \App\Models\Poster::where('aktif', true)
            ->where(function($q) use ($key) {
                $q->where('slug', $key)->orWhere('id', $key);
            })
            ->firstOrFail();

        $otherPosters = \App\Models\Poster::where('aktif', true)
            ->where('id', '!=', $poster->id)
            ->latest()
            ->take(4)
            ->get();

        return view('pages.pengumuman-detail', [
            'title'        => $poster->judul,
            'subtitle'     => 'Dipublikasikan pada ' . $poster->created_at->isoFormat('D MMMM Y'),
            'poster'       => $poster,
            'otherPosters' => $otherPosters,
        ]);
    }

    public function akreditasi()
    {
        return view('pages.akreditasi', [
            'title'    => 'Akreditasi PAI',
            'subtitle' => 'Sertifikat Akreditasi Program Studi Pendidikan Agama Islam STAIMAS Wonogiri',
        ]);
    }

    // --- PROFIL ---
    public function sejarah()
    {
        return view('pages.sejarah', [
            'title'    => 'Sejarah PAI',
            'subtitle' => 'Sejarah singkat berdirinya Program Studi Pendidikan Agama Islam',
        ]);
    }

    public function strukturOrganisasi()
    {
        return view('pages.struktur-organisasi', [
            'title'    => 'Struktur Organisasi',
            'subtitle' => 'Struktur kepemimpinan dan organisasi Prodi PAI',
        ]);
    }

    // --- AKADEMIK ---
    public function rps()
    {
        return view('pages.rps', [
            'title'    => 'Rencana Pembelajaran Semester (RPS)',
            'subtitle' => 'Dokumen RPS mata kuliah Program Studi PAI',
        ]);
    }

    public function kalenderAkademik()
    {
        return view('pages.kalender-akademik', [
            'title'    => 'Kalender Akademik',
            'subtitle' => 'Jadwal dan kalender akademik tahun berjalan',
        ]);
    }

    public function panduanTa()
    {
        return view('pages.panduan-ta', [
            'title'    => 'Panduan Tugas Akhir / Skripsi',
            'subtitle' => 'Pedoman penulisan dan pelaksanaan Tugas Akhir mahasiswa',
        ]);
    }

    public function pedomanPpl()
    {
        return view('pages.pedoman-ppl', [
            'title'    => 'Pedoman PPL',
            'subtitle' => 'Panduan pelaksanaan Praktik Pengalaman Lapangan',
        ]);
    }

    public function labMicroteaching()
    {
        return view('pages.lab-microteaching', [
            'title'    => 'Lab Microteaching',
            'subtitle' => 'Informasi fasilitas dan kegiatan Laboratorium Microteaching',
        ]);
    }

    // --- PMB & KEMAHASISWAAN ---
    public function infoPmb()
    {
        return view('pages.info-pmb', [
            'title'    => 'Info Pendaftaran Mahasiswa Baru',
            'subtitle' => 'Informasi pendaftaran, syarat, dan jalur penerimaan mahasiswa baru',
        ]);
    }

    public function kegiatanPrestasi()
    {
        return view('pages.kegiatan-prestasi', [
            'title'    => 'Kegiatan & Prestasi Mahasiswa',
            'subtitle' => 'Dokumentasi kegiatan kemahasiswaan dan prestasi akademik/non-akademik',
        ]);
    }

    // --- TRIDHARMA ---
    public function penelitian()
    {
        return view('pages.penelitian', [
            'title'    => 'Penelitian',
            'subtitle' => 'Daftar penelitian dosen dan mahasiswa Prodi PAI',
        ]);
    }

    public function pengabdian()
    {
        return view('pages.pengabdian', [
            'title'    => 'Pengabdian Masyarakat',
            'subtitle' => 'Kegiatan Pengabdian kepada Masyarakat (PkM) Prodi PAI',
        ]);
    }

    public function kerjasama()
    {
        return view('pages.kerjasama', [
            'title'    => 'Kerjasama & MoU',
            'subtitle' => 'Jejaring kerjasama Institusi dan Prodi PAI',
        ]);
    }

    public function jurnal()
    {
        return view('pages.jurnal', [
            'title'    => 'Jurnal Prodi PAI (Man Ana)',
            'subtitle' => 'Jurnal ilmiah berkala Program Studi Pendidikan Agama Islam',
        ]);
    }

    // --- DOKUMEN AKREDITASI ---
    public function dokumenAkreditasi()
    {
        return view('pages.dokumen-akreditasi', [
            'title'    => 'Dokumen Akreditasi (9 Kriteria)',
            'subtitle' => 'Dokumen pendukung akreditasi LAMDIK Prodi PAI',
        ]);
    }

}