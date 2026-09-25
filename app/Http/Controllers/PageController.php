<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slide;
use App\Models\Berita;
use App\Models\Dosen;
use App\Models\Poster;
use App\Models\Kategori;
use App\Models\Dokumen;

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
        $dokumens = Dokumen::where('aktif', true)->where('kategori', 'kurikulum')->orderBy('urutan')->get();
        return view('pages.kurikulum', [
            'title'    => 'Kurikulum PAI',
            'subtitle' => 'Struktur mata kuliah dan kurikulum akademik Program Studi S1 PAI',
            'dokumens' => $dokumens,
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
            'posters' => Poster::where('aktif', true)->latest()->get(),
        ]);
    }

    public function pengumumanShow($key)
    {
        $poster = Poster::where('aktif', true)
            ->where(function($q) use ($key) {
                $q->where('slug', $key)->orWhere('id', $key);
            })
            ->firstOrFail();

        $otherPosters = Poster::where('aktif', true)
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
        $dokumens = Dokumen::where('aktif', true)
            ->where('kategori', 'sk_akreditasi')
            ->orderBy('urutan')
            ->get();

        return view('pages.akreditasi', [
            'title'    => 'Akreditasi PAI',
            'subtitle' => 'Sertifikat Akreditasi Program Studi Pendidikan Agama Islam STAIMAS Wonogiri',
            'dokumens' => $dokumens,
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
        $dokumens = Dokumen::where('aktif', true)->where('kategori', 'rps')->orderBy('urutan')->get();
        return view('pages.rps', [
            'title'    => 'Rencana Pembelajaran Semester (RPS)',
            'subtitle' => 'Dokumen RPS mata kuliah Program Studi PAI',
            'dokumens' => $dokumens,
        ]);
    }

    public function kalenderAkademik()
    {
        $dokumens = Dokumen::where('aktif', true)->where('kategori', 'kalender')->orderBy('urutan')->get();
        return view('pages.kalender-akademik', [
            'title'    => 'Kalender Akademik',
            'subtitle' => 'Jadwal dan kalender akademik tahun berjalan',
            'dokumens' => $dokumens,
        ]);
    }

    public function panduanTa()
    {
        $dokumens = Dokumen::where('aktif', true)->where('kategori', 'panduan_ta')->orderBy('urutan')->get();
        return view('pages.panduan-ta', [
            'title'    => 'Panduan Tugas Akhir / Skripsi',
            'subtitle' => 'Pedoman penulisan dan pelaksanaan Tugas Akhir mahasiswa',
            'dokumens' => $dokumens,
        ]);
    }

    public function pedomanPpl()
    {
        $dokumens = Dokumen::where('aktif', true)->where('kategori', 'pedoman_ppl')->orderBy('urutan')->get();
        return view('pages.pedoman-ppl', [
            'title'    => 'Pedoman PPL',
            'subtitle' => 'Panduan pelaksanaan Praktik Pengalaman Lapangan',
            'dokumens' => $dokumens,
        ]);
    }

    public function labMicroteaching()
    {
        $dokumens = Dokumen::where('aktif', true)->where('kategori', 'lab_microteaching')->orderBy('urutan')->get();
        return view('pages.lab-microteaching', [
            'title'    => 'Lab Microteaching',
            'subtitle' => 'Informasi fasilitas dan kegiatan Laboratorium Microteaching',
            'dokumens' => $dokumens,
        ]);
    }

    // --- PMB & KEMAHASISWAAN ---
    public function infoPmb()
    {
        $posters = Poster::where('aktif', true)
            ->where('kategori', 'like', '%PMB%')
            ->orWhere('judul', 'like', '%PMB%')
            ->orWhere('judul', 'like', '%Pendaftaran%')
            ->latest()
            ->get();

        $beritas = Berita::with('kategori')
            ->where('aktif', true)
            ->where(function($q) {
                $q->where('judul', 'like', '%PMB%')
                  ->orWhere('judul', 'like', '%Pendaftaran%')
                  ->orWhereHas('kategori', fn($k) => $k->where('slug', 'pmb')->orWhere('slug', 'akademik'));
            })
            ->latest('tanggal')
            ->get();

        return view('pages.info-pmb', [
            'title'    => 'Info Pendaftaran Mahasiswa Baru (PMB)',
            'subtitle' => 'Informasi pendaftaran, alur, syarat, poster resmi, dan jalur penerimaan mahasiswa baru PAI',
            'posters'  => $posters,
            'beritas'  => $beritas,
        ]);
    }

    public function kegiatanPrestasi()
    {
        $beritas = Berita::with('kategori')
            ->where('aktif', true)
            ->whereHas('kategori', function($q) {
                $q->whereIn('slug', ['prestasi', 'kegiatan']);
            })
            ->latest('tanggal')
            ->get();

        $posters = Poster::where('aktif', true)->latest()->get();

        return view('pages.kegiatan-prestasi', [
            'title'    => 'Kegiatan & Prestasi Mahasiswa',
            'subtitle' => 'Dokumentasi kegiatan kemahasiswaan, prestasi akademik/non-akademik, dan poster pengumuman',
            'beritas'  => $beritas,
            'posters'  => $posters,
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
        $dokumens = Dokumen::where('aktif', true)
            ->where('kategori', 'like', 'lamdik_%')
            ->orderBy('urutan')
            ->get()
            ->groupBy('kategori');

        return view('pages.dokumen-akreditasi', [
            'title'        => 'Dokumen Akreditasi (9 Kriteria LAMDIK)',
            'subtitle'     => 'Dokumen pendukung akreditasi LAMDIK Program Studi PAI STAIMAS Wonogiri',
            'dokumens'     => $dokumens,
            'kriteriaList' => [
                'lamdik_1' => ['title' => 'Kriteria 1: Visi, Misi, Tujuan, dan Strategi', 'icon' => 'fas fa-compass'],
                'lamdik_2' => ['title' => 'Kriteria 2: Tata Kelola, Tata Pamong, dan Kerjasama', 'icon' => 'fas fa-sitemap'],
                'lamdik_3' => ['title' => 'Kriteria 3: Mahasiswa', 'icon' => 'fas fa-user-graduate'],
                'lamdik_4' => ['title' => 'Kriteria 4: Sumber Daya Manusia', 'icon' => 'fas fa-chalkboard-teacher'],
                'lamdik_5' => ['title' => 'Kriteria 5: Keuangan, Sarana, dan Prasarana', 'icon' => 'fas fa-coins'],
                'lamdik_6' => ['title' => 'Kriteria 6: Pendidikan', 'icon' => 'fas fa-book-open'],
                'lamdik_7' => ['title' => 'Kriteria 7: Penelitian', 'icon' => 'fas fa-flask'],
                'lamdik_8' => ['title' => 'Kriteria 8: Pengabdian kepada Masyarakat', 'icon' => 'fas fa-hands-helping'],
                'lamdik_9' => ['title' => 'Kriteria 9: Luaran dan Capaian Tridharma', 'icon' => 'fas fa-trophy'],
            ]
        ]);
    }
}
