<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class hasil_nilai extends Model
{
    use HasFactory;
    protected $table = 'hasil_nilai';
    protected $fillable = [
        'siswa_id',
        'kelas_id',
        'mata_pelajaran_id',
        'category_soal_id',
        'tahun_ajaran',
        'semester_id',
        'tanggal',
        'nilai',
        'total_soal',
        'master_category_soal_id'
    ];
}
