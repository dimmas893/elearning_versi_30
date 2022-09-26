<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHasilNilaiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hasil_nilai', function (Blueprint $table) {
            $table->id();
            $table->integer('siswa_id')->nullable();
            $table->integer('mata_pelajaran_id')->nullable();
            $table->integer('kelas_id')->nullable();
            $table->integer('category_soal_id')->nullable();
            $table->integer('tahun_ajaran')->nullable();
            $table->integer('semester_id')->nullable();
            $table->integer('pertemuan')->nullable();
            $table->string('tanggal')->nullable();
            $table->integer('nilai')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hasil_nilai');
    }
}
