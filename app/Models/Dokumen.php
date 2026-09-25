<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dokumen extends Model
{
    protected $fillable = [
        'judul',
        'kategori',
        'file_path',
        'keterangan',
        'urutan',
        'aktif',
    ];

    protected $casts = [
        'aktif' => 'boolean',
    ];

    public static function getKategoriList()
    {
        return [
            'lamdik_1' => 'LAMDIK Kriteria 1: Visi, Misi, Tujuan, dan Strategi',
            'lamdik_2' => 'LAMDIK Kriteria 2: Tata Kelola, Tata Pamong, dan Kerjasama',
            'lamdik_3' => 'LAMDIK Kriteria 3: Mahasiswa',
            'lamdik_4' => 'LAMDIK Kriteria 4: Sumber Daya Manusia',
            'lamdik_5' => 'LAMDIK Kriteria 5: Keuangan, Sarana, dan Prasarana',
            'lamdik_6' => 'LAMDIK Kriteria 6: Pendidikan',
            'lamdik_7' => 'LAMDIK Kriteria 7: Penelitian',
            'lamdik_8' => 'LAMDIK Kriteria 8: Pengabdian kepada Masyarakat',
            'lamdik_9' => 'LAMDIK Kriteria 9: Luaran dan Capaian Tridharma',
            'kurikulum'   => 'Dokumen Kurikulum',
            'rps'         => 'Dokumen RPS',
            'kalender'    => 'Kalender Akademik',
            'panduan_ta'  => 'Panduan Tugas Akhir / Skripsi',
            'pedoman_ppl' => 'Pedoman PPL',
            'sk_akreditasi' => 'SK Akreditasi & Izin Operational',
        ];
    }
}
