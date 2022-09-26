<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hasil_soal extends Model
{
    use HasFactory;

    protected $table = 'hasil_soal';
    protected $fillable = [
        'siswa_id',
        'hasil',
        'jawaban',
        'soal_id',
        'mata_pelajaran_id',
        'category_soal_id',
        'tahun_ajaran',
        'semester_id',
        'tanggal',
        'kelas_id'
    ];
}
