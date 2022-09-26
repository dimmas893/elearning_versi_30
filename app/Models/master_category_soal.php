<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class master_category_soal extends Model
{
    use HasFactory;
    protected $table = 'master_category_soal';
    protected $fillable = [
        'name',
    ];
}
