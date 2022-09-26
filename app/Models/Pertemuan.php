<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pertemuan extends Model
{
    use HasFactory;
    protected $table = 'pertemuan';
    protected $fillable = ['kelas_id', 'pertemuan', 'jadwal_id', 'tanggal', 'guru_id', 'semester_id', 'tahun_ajaran'];
}
