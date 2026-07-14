<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Dosen extends Model
{
    use HasUuids;

    protected $fillable = [
        'nama', 'slug', 'gelar_depan', 'gelar_belakang', 'jabatan', 'program_studi', 'foto', 'urutan', 'aktif',
        'nidn', 'nuptk', 'jabatan_akademik', 'status', 'email', 'google_scholar', 'pendidikan_terakhir'
    ];
    protected $casts = ['aktif' => 'boolean'];

    public function getNamaLengkapAttribute(): string
    {
        return trim(($this->gelar_depan ? $this->gelar_depan . ' ' : '') . $this->nama . ($this->gelar_belakang ? ', ' . $this->gelar_belakang : ''));
    }
}