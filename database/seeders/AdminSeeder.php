<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Slide;
use App\Models\Kategori;
use App\Models\Berita;
use App\Models\Dosen;
use App\Models\Poster;
use Illuminate\Support\Str;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        // ── Admin User ──
        User::updateOrCreate(
            ['email' => 'admin@pai.staimas.ac.id'],
            [
                'name'      => 'Admin PAI STAIMAS',
                'password'  => Hash::make('admin123'),
                'is_admin'  => true,
            ]
        );

        // ── Slides ──
        Slide::truncate();
        $slides = [
            ['judul' => 'Mahasiswa PAI STAIMAS Wonogiri', 'gambar' => 'slides/slide1.png', 'urutan' => 1, 'aktif' => true],
            ['judul' => 'Kegiatan Perkuliahan PAI',        'gambar' => 'slides/slide2.png', 'urutan' => 2, 'aktif' => true],
        ];
        foreach ($slides as $s) {
            Slide::create($s);
        }

        // ── Kategori Berita ──
        Kategori::truncate();
        $kategoris = [
            ['nama' => 'Kegiatan',   'slug' => 'kegiatan'],
            ['nama' => 'Prestasi',   'slug' => 'prestasi'],
            ['nama' => 'Akademik',   'slug' => 'akademik'],
            ['nama' => 'Pengabdian', 'slug' => 'pengabdian'],
        ];
        foreach ($kategoris as $k) {
            Kategori::create($k);
        }

        $katKegiatan   = Kategori::where('slug', 'kegiatan')->first();
        $katPrestasi   = Kategori::where('slug', 'prestasi')->first();
        $katAkademik   = Kategori::where('slug', 'akademik')->first();
        $katPengabdian = Kategori::where('slug', 'pengabdian')->first();

        // ── Berita ──
        Berita::truncate();
        $beritas = [
            [
                'kategori_id' => $katKegiatan->id,
                'judul'       => 'Pembekalan KKN Mahasiswa PAI Angkatan 2025',
                'slug'        => 'pembekalan-kkn-2025',
                'konten'      => 'Program Studi Pendidikan Agama Islam (PAI) STAIMAS Wonogiri menyelenggarakan kegiatan pembekalan bagi mahasiswa yang akan melaksanakan Kuliah Kerja Nyata (KKN) Reguler Angkatan 2025. Pembekalan difokuskan pada penguatan metode dakwah di masyarakat dan penyusunan modul bimbingan keagamaan bagi warga setempat. Mahasiswa PAI diharapkan mampu berkontribusi nyata dan memberikan dampak positif di lingkungan tempat mereka bertugas.',
                'gambar'      => null,
                'tanggal'     => '2026-07-02',
                'aktif'       => true,
            ],
            [
                'kategori_id' => $katPrestasi->id,
                'judul'       => 'Mahasiswa PAI Raih Medali di MTQ Nasional',
                'slug'        => 'medali-mtq-nasional',
                'konten'      => 'Kabar membanggakan datang dari panggung nasional. Delegasi mahasiswa Program Studi PAI STAIMAS Wonogiri berhasil meraih prestasi gemilang dalam ajang perlombaan Musabaqah Tilawatil Quran (MTQ) tingkat nasional. Prestasi ini membuktikan bahwa mahasiswa PAI tidak hanya unggul di ruang kelas, tetapi juga kompeten di bidang seni keislaman.',
                'gambar'      => null,
                'tanggal'     => '2026-06-15',
                'aktif'       => true,
            ],
            [
                'kategori_id' => $katAkademik->id,
                'judul'       => 'Seminar Nasional: Edupreneurship dalam Kurikulum PAI',
                'slug'        => 'seminar-edupreneurship-pai',
                'konten'      => 'Seminar nasional ini menghadirkan pakar pendidikan Islam dan praktisi edupreneurship guna membahas relevansi kurikulum PAI dengan kebutuhan dunia kerja saat ini. Penguatan jiwa kewirausahaan berbasis nilai Islam menjadi salah satu poin penting yang harus diintegrasikan ke dalam materi pengajaran guru PAI modern.',
                'gambar'      => null,
                'tanggal'     => '2026-06-05',
                'aktif'       => true,
            ],
        ];
        foreach ($beritas as $b) {
            Berita::create($b);
        }

        // ── Dosen ──
        Dosen::truncate();
        $dosens = [
            ['nama' => 'Abdul Rochman, M.Pd',           'jabatan' => 'Ketua Program Studi', 'foto' => 'https://www.staimaswonogiri.ac.id/wp-content/uploads/2025/07/Pak-abdul.png',    'urutan' => 1],
            ['nama' => 'Amir Mukminin, S.Pd.I, M.Pd',  'jabatan' => 'Dosen Tetap PAI',    'foto' => 'https://www.staimaswonogiri.ac.id/wp-content/uploads/2025/07/pak-amir.png',     'urutan' => 2],
            ['nama' => 'Dr. Ali Mahbub, S.Pd.I, M.Pd', 'jabatan' => 'Dosen Tetap PAI',    'foto' => 'https://www.staimaswonogiri.ac.id/wp-content/uploads/2025/07/pak-ali.png',      'urutan' => 3],
            ['nama' => 'Dr. Dewi Agustini, S.Sos., M.M','jabatan' => 'Dosen Tetap PAI',   'foto' => 'https://www.staimaswonogiri.ac.id/wp-content/uploads/2025/07/bu-dewi-1.png',    'urutan' => 4],
            ['nama' => 'Maulana Iskandar, M.Pd',        'jabatan' => 'Dosen Tetap PAI',    'foto' => 'https://www.staimaswonogiri.ac.id/wp-content/uploads/2025/07/pak-maulana-1.png','urutan' => 5],
            ['nama' => 'Ratih, M.Pd',                   'jabatan' => 'Dosen Tetap PAI',    'foto' => 'https://www.staimaswonogiri.ac.id/wp-content/uploads/2025/07/bu-ratih.png',    'urutan' => 6],
            ['nama' => 'Suliwati, M.Pd',                'jabatan' => 'Dosen Tetap PAI',    'foto' => 'https://www.staimaswonogiri.ac.id/wp-content/uploads/2025/07/mbak-suli.png',   'urutan' => 7],
        ];
        foreach ($dosens as $d) {
            Dosen::create(array_merge($d, ['aktif' => true]));
        }

        // ── Poster ──
        Poster::truncate();
        $posters = [
            ['judul' => 'PMB PAI 2025',       'deskripsi' => 'Buka Pendaftaran Mahasiswa Baru Program Studi PAI', 'gambar' => null, 'kategori' => 'PMB'],
            ['judul' => 'Beasiswa Mahasiswa',  'deskripsi' => 'Info Beasiswa Khusus Mahasiswa PAI Berprestasi',    'gambar' => null, 'kategori' => 'Beasiswa'],
            ['judul' => 'KKN PAI 2026',        'deskripsi' => 'Pendaftaran dan Penempatan KKN Angkatan 2026',      'gambar' => null, 'kategori' => 'Kegiatan'],
            ['judul' => 'Seminar Nasional',    'deskripsi' => 'Seminar Edupreneurship – Terbuka Untuk Umum',       'gambar' => null, 'kategori' => 'Akademik'],
        ];
        foreach ($posters as $p) {
            Poster::create(array_merge($p, ['aktif' => true]));
        }
    }
}
