<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

// Auth::routes();

//sekolah
Route::get('/sekolah', [App\Http\Controllers\Admin\SekolahController::class, 'index'])->name('sekolah');
Route::get('/sekolah/all', [App\Http\Controllers\Admin\SekolahController::class, 'all'])->name('sekolah-all');
Route::get('/sekolah/edit', [App\Http\Controllers\Admin\SekolahController::class, 'edit'])->name('sekolah-edit');
Route::post('/sekolah/update', [App\Http\Controllers\Admin\SekolahController::class, 'update'])->name('sekolah-update');

//kelas
Route::get('/kelas', [App\Http\Controllers\Admin\KelasController::class, 'index'])->name('kelas');
Route::post('/kelas/store', [App\Http\Controllers\Admin\KelasController::class, 'store'])->name('kelas-store');
Route::get('/kelas/all', [App\Http\Controllers\Admin\KelasController::class, 'all'])->name('kelas-all');
Route::get('/kelas/edit', [App\Http\Controllers\Admin\KelasController::class, 'edit'])->name('kelas-edit');
Route::post('/kelas/update', [App\Http\Controllers\Admin\KelasController::class, 'update'])->name('kelas-update');
Route::delete('/kelas/delete', [App\Http\Controllers\Admin\KelasController::class, 'delete'])->name('kelas-delete');


//jurusan
Route::get('/jurusan', [App\Http\Controllers\Admin\JurusanController::class, 'index'])->name('jurusan');
Route::post('/jurusan/store', [App\Http\Controllers\Admin\JurusanController::class, 'store'])->name('jurusan-store');
Route::get('/jurusan/all', [App\Http\Controllers\Admin\JurusanController::class, 'all'])->name('jurusan-all');
Route::get('/jurusan/edit', [App\Http\Controllers\Admin\JurusanController::class, 'edit'])->name('jurusan-edit');
Route::post('/jurusan/update', [App\Http\Controllers\Admin\JurusanController::class, 'update'])->name('jurusan-update');
Route::delete('/jurusan/delete', [App\Http\Controllers\Admin\JurusanController::class, 'delete'])->name('jurusan-delete');

//mata_pelajaran
Route::get('/mata_pelajaran', [App\Http\Controllers\Admin\MataPelajaranController::class, 'index'])->name('mata-pelajaran');
Route::post('/mata_pelajaran/store', [App\Http\Controllers\Admin\MataPelajaranController::class, 'store'])->name('mata_pelajaran-store');
Route::get('/mata_pelajaran/all', [App\Http\Controllers\Admin\MataPelajaranController::class, 'all'])->name('mata');
Route::get('/mata_pelajaran/edit', [App\Http\Controllers\Admin\MataPelajaranController::class, 'edit'])->name('mata_pelajaran-edit');
Route::post('/mata_pelajaran/update', [App\Http\Controllers\Admin\MataPelajaranController::class, 'update'])->name('mata_pelajaran-update');
Route::delete('/mata_pelajaran/delete', [App\Http\Controllers\Admin\MataPelajaranController::class, 'delete'])->name('mata_pelajaran-delete');

//guru
Route::get('/guru', [App\Http\Controllers\Admin\GuruController::class, 'index'])->name('gurus');
Route::post('/guru/store', [App\Http\Controllers\Admin\GuruController::class, 'store'])->name('guru-store');
Route::get('/guru/all', [App\Http\Controllers\Admin\GuruController::class, 'all'])->name('guru-all');
Route::get('/guru/edit', [App\Http\Controllers\Admin\GuruController::class, 'edit'])->name('guru-edit');
Route::post('/guru/update', [App\Http\Controllers\Admin\GuruController::class, 'update'])->name('guru-update');
Route::delete('/guru/delete', [App\Http\Controllers\Admin\GuruController::class, 'delete'])->name('guru-delete');

//tu
Route::get('/tu', [App\Http\Controllers\Admin\TuController::class, 'index'])->name('tus');
Route::post('/tu/store', [App\Http\Controllers\Admin\TuController::class, 'store'])->name('tu-store');
Route::get('/tu/all', [App\Http\Controllers\Admin\TuController::class, 'all'])->name('tu-all');
Route::get('/tu/edit', [App\Http\Controllers\Admin\TuController::class, 'edit'])->name('tu-edit');
Route::post('/tu/update', [App\Http\Controllers\Admin\TuController::class, 'update'])->name('tu-update');
Route::delete('/tu/delete', [App\Http\Controllers\Admin\TuController::class, 'delete'])->name('tu-delete');


//siswa
Route::get('/siswa', [App\Http\Controllers\Admin\SiswaController::class, 'index'])->name('siswa');
Route::post('/siswa/store', [App\Http\Controllers\Admin\SiswaController::class, 'store'])->name('siswa-store');
Route::get('/siswa/all', [App\Http\Controllers\Admin\SiswaController::class, 'all'])->name('siswa-all');
Route::get('/siswa/edit', [App\Http\Controllers\Admin\SiswaController::class, 'edit'])->name('siswa-edit');
Route::post('/siswa/update', [App\Http\Controllers\Admin\SiswaController::class, 'update'])->name('siswa-update');
Route::delete('/siswa/delete', [App\Http\Controllers\Admin\SiswaController::class, 'delete'])->name('siswa-delete');

//ruangan
Route::get('/ruangan', [App\Http\Controllers\Admin\RuanganController::class, 'index'])->name('ruangan');
Route::post('/ruangan/store', [App\Http\Controllers\Admin\RuanganController::class, 'store'])->name('ruangan-store');
Route::get('/ruangan/all', [App\Http\Controllers\Admin\RuanganController::class, 'all'])->name('ruangan-all');
Route::get('/ruangan/edit', [App\Http\Controllers\Admin\RuanganController::class, 'edit'])->name('ruangan-edit');
Route::post('/ruangan/update', [App\Http\Controllers\Admin\RuanganController::class, 'update'])->name('ruangan-update');
Route::delete('/ruangan/delete', [App\Http\Controllers\Admin\RuanganController::class, 'delete'])->name('ruangan-delete');

//ruangan
Route::get('/penjagaperpus', [App\Http\Controllers\Admin\PenjagaPerpusController::class, 'index'])->name('penjagaperpus');
Route::post('/penjagaperpus/store', [App\Http\Controllers\Admin\PenjagaPerpusController::class, 'store'])->name('penjagaperpus-store');
Route::get('/penjagaperpus/all', [App\Http\Controllers\Admin\PenjagaPerpusController::class, 'all'])->name('penjagaperpus-all');
Route::get('/penjagaperpus/edit', [App\Http\Controllers\Admin\PenjagaPerpusController::class, 'edit'])->name('penjagaperpus-edit');
Route::post('/penjagaperpus/update', [App\Http\Controllers\Admin\PenjagaPerpusController::class, 'update'])->name('penjagaperpus-update');
Route::delete('/penjagaperpus/delete', [App\Http\Controllers\Admin\PenjagaPerpusController::class, 'delete'])->name('penjagaperpus-delete');

//jadwal
Route::get('/jadwals', [App\Http\Controllers\Admin\JadwaCOntroller::class, 'index'])->name('jadwals');
Route::post('/jadwals/store', [App\Http\Controllers\Admin\JadwaCOntroller::class, 'store'])->name('jadwals-store');
Route::get('/jadwals/all', [App\Http\Controllers\Admin\JadwaCOntroller::class, 'all'])->name('jadwals-all');
Route::get('/jadwals/edit', [App\Http\Controllers\Admin\JadwaCOntroller::class, 'edit'])->name('jadwals-edit');
Route::post('/jadwals/update', [App\Http\Controllers\Admin\JadwaCOntroller::class, 'update'])->name('jadwals-update');
Route::delete('/jadwals/delete', [App\Http\Controllers\Admin\JadwaCOntroller::class, 'delete'])->name('jadwals-delete');

//walikelas
Route::get('/walikelas', [App\Http\Controllers\Admin\WaliKelasController::class, 'index'])->name('wali_kelas');
Route::post('/walikelas/store', [App\Http\Controllers\Admin\WaliKelasController::class, 'store'])->name('walikelas-store');
Route::get('/walikelas/all', [App\Http\Controllers\Admin\WaliKelasController::class, 'all'])->name('walikelas-all');
Route::get('/walikelas/edit', [App\Http\Controllers\Admin\WaliKelasController::class, 'edit'])->name('walikelas-edit');
Route::post('/walikelas/update', [App\Http\Controllers\Admin\WaliKelasController::class, 'update'])->name('walikelas-update');
Route::delete('/walikelas/delete', [App\Http\Controllers\Admin\WaliKelasController::class, 'delete'])->name('walikelas-delete');


//tugas role guru
Route::get('/tugas/guru', [App\Http\Controllers\Guru\TugasController::class, 'index'])->name('tugas_guru');
Route::post('/tugas/store', [App\Http\Controllers\Admin\TugasController::class, 'store'])->name('tugas-store');
Route::get('/tugas/all', [App\Http\Controllers\Admin\TugasController::class, 'all'])->name('tugas-all');
Route::get('/tugas/edit', [App\Http\Controllers\Admin\TugasController::class, 'edit'])->name('tugas-edit');
Route::post('/tugas/update', [App\Http\Controllers\Admin\TugasController::class, 'update'])->name('tugas-update');
Route::delete('/tugas/delete', [App\Http\Controllers\Admin\TugasController::class, 'delete'])->name('tugas-delete');


Route::get('/login', [App\Http\Controllers\Auth\GuruAuthController::class, 'login'])->name('admin.login');
Route::post('/login', [App\Http\Controllers\Auth\GuruAuthController::class, 'postLogin']);
Route::get('logout', [App\Http\Controllers\Auth\GuruAuthController::class, 'logout'])->name('logout');



// /jadwal guru
Route::get('/jadwal-mengajar', [App\Http\Controllers\Guru\GuruController::class, 'jadwalmengajar'])->name('jadwals-mengajar');

// kelas guru
Route::get('/mengajar/guru/{id}', [App\Http\Controllers\Guru\GuruController::class, 'masuk'])->name('kelas-masuk');
Route::get('/mengajar/absensi/get/{id}', [App\Http\Controllers\Guru\GuruController::class, 'storeAbsenget'])->name('kelas.store_absen_get');
Route::post('/mengajar/absensi/{id}', [App\Http\Controllers\Guru\GuruController::class, 'storeAbsen'])->name('kelas.store_absen');

//guru tugas
Route::post('/tugas/create', [App\Http\Controllers\Guru\GuruController::class, 'tugas'])->name('tugas');
Route::post('/ulangan/create', [App\Http\Controllers\Guru\GuruController::class, 'ulangan'])->name('ulangan');
Route::post('/ujian/create', [App\Http\Controllers\Guru\GuruController::class, 'ujian'])->name('ujian');

Route::post('/materi/create', [App\Http\Controllers\Guru\GuruController::class, 'materi'])->name('materi');

Route::get('/materi/cari/{id}', [App\Http\Controllers\Guru\GuruController::class, 'cari_materi_filter'])->name('cari_materi_filter');
Route::get('/ulangan/cari/{id}', [App\Http\Controllers\Guru\GuruController::class, 'cari_ulangan_filter'])->name('cari_ulangan_filter');
Route::get('/ujian/cari/{id}', [App\Http\Controllers\Guru\GuruController::class, 'cari_ujian_filter'])->name('cari_ujian_filter');
Route::get('/materi/cari/{id}', [App\Http\Controllers\Guru\GuruController::class, 'cari_materi_filter'])->name('cari_materi_filter');


Route::get('/tugas/cari/siswa/{id}', [App\Http\Controllers\Siswa\SiswaController::class, 'cari_tugas_filter'])->name('cari_tugas_filter_siswa');
Route::get('/materi/cari/siswa/{id}', [App\Http\Controllers\Siswa\SiswaController::class, 'cari_materi_filter'])->name('cari_materi_filter_siswa');
Route::get('/ulangan/cari/siswa/{id}', [App\Http\Controllers\Siswa\SiswaController::class, 'cari_ulangan_filter'])->name('cari_ulangan_filter_siswa');
Route::get('/ujian/cari/siswa/{id}', [App\Http\Controllers\Siswa\SiswaController::class, 'cari_ujian_filter'])->name('cari_ujian_filter_siswa');


Route::get('/tugas/semua', [App\Http\Controllers\Guru\GuruController::class, 'semua_tugas'])->name('semua_tugas');

Route::get('/tugas/nilai/{id}', [App\Http\Controllers\Guru\GuruController::class, 'kasih_nilai'])->name('kasih_nilai');


Route::get('/halaman/siswas', [App\Http\Controllers\Siswa\SiswaController::class, 'index'])->name('halaman_siswa');
Route::get('/halaman/siswa/jadwal', [App\Http\Controllers\Siswa\SiswaController::class, 'jadwal'])->name('halaman_siswa_jadwal');

//jadwal siswa
Route::get('/mengajar/{id}', [App\Http\Controllers\Siswa\SiswaController::class, 'masuk'])->name('kelas-masuk-siswa');
Route::post('/absensi/{id}', [App\Http\Controllers\Siswa\SiswaController::class, 'absen'])->name('absen-siswa');

//ambiltugas
Route::get('/ambil_tugas/{id}', [App\Http\Controllers\Siswa\SiswaController::class, 'ambil_tugas'])->name('ambil_tugas');


Route::get('/jawaban/siswa/{id}/', [App\Http\Controllers\Siswa\SiswaController::class, 'get_jawaban_siswa'])->name('get_jawaban_siswa');
Route::post('/jawaban/siswa/kirim/{id}', [App\Http\Controllers\Siswa\SiswaController::class, 'jawaban_siswa'])->name('jawaban_siswa');

Route::get('/jawaban/guru/{id}', [App\Http\Controllers\Guru\GuruController::class, 'get_jawaban_siswa_nilai'])->name('nilai');
Route::post('/jawaban/guru/{id}', [App\Http\Controllers\Guru\GuruController::class, 'jawaban_siswa_nilai'])->name('jawaban_siswa_nilai');

Route::post('/jawaban/dsds', [App\Http\Controllers\Guru\GuruController::class, 'raport_create'])->name('raport_create');

Route::post('/buat_absen', [App\Http\Controllers\Guru\GuruController::class, 'buat_absen'])->name('buat_absen');


Route::get('/semua/nilai', [App\Http\Controllers\Guru\RaportController::class, 'pp'])->name('semua-nilai');
Route::get('/semua/raport/get2', [App\Http\Controllers\Guru\RaportController::class, 'get_raport_admin'])->name('raport-2');
Route::get('/semua/raport/get', [App\Http\Controllers\Guru\RaportController::class, 'raport'])->name('raport');
Route::get('/semua/raport/{id}', [App\Http\Controllers\Guru\RaportController::class, 'get_raport'])->name('get_raport');
Route::post('/semua/raport/{id}', [App\Http\Controllers\Guru\RaportController::class, 'raport_save'])->name('raport_save');


Route::get('/siswa/raport', [App\Http\Controllers\Guru\RaportController::class, 'index'])->name('raport_siswa');

// Route::get('/cari/raport', [App\Http\Controllers\Guru\RaportController::class, 'cari_raport'])->name('cari_raport');
// Route::get('/raport/cari', [App\Http\Controllers\Guru\RaportController::class, 'raport_cari'])->name('raport_cari');

// Route::get('/tugas/cari/{id}', [App\Http\Controllers\Guru\GuruController::class, 'cari_tugas_filter'])->name('cari_tugas_filter');


// Route::get('/nilai/wali_kelas/get', [App\Http\Controllers\Guru\RaportController::class, 'wali_kelas_nilai'])->name('wali_kelas_nilai');
// Route::get('/nilai/wali_kelas/getcari', [App\Http\Controllers\Guru\RaportController::class, 'wali_kelas_nilai_cari'])->name('wali_kelas_nilai_cari');
// Route::get('/raport/wali_kelas/get', [App\Http\Controllers\Guru\RaportController::class, 'wali_kelas'])->name('wali_kelas_raport');

Route::get('/raport/wali_kelas/cari_raport', [App\Http\Controllers\Guru\RaportController::class, 'wali_kelas_raport_cari'])->name('wali_kelas_raport_cari');

Route::get('prosesRaport', [App\Http\Controllers\Guru\RaportController::class, 'prosesRaport'])->name('prosesRaport');


Route::get('/raport/wali_kelas/cari/{id}', [App\Http\Controllers\Guru\RaportController::class, 'wali_kelas_raport_cari_id'])->name('wali_kelas_raport_cari_id');
Route::post('/raport/wali_kelas/cari/{id}', [App\Http\Controllers\Guru\RaportController::class, 'wali_kelas_raport_cari_id_post'])->name('wali_kelas_raport_cari_id_post');


Route::get('/halaman/guru', [App\Http\Controllers\Guru\DashboardController::class, 'index'])->name('dashboard-guru');


// Route::get('/halaman/guru', [App\Http\Controllers\Guru\GuruController::class, 'index'])->name('halaman-guru');
// Route::get('/category_soal/{master_category_soal}/{jadwal}', [App\Http\Controllers\Guru\SoalController::class, 'category_soal'])->name('category_soal');
Route::get('/mata_pelajaran/{category_soal}/{jadwal}', [App\Http\Controllers\Guru\SoalController::class, 'index'])->name('soal');
Route::get('/mata_pelajaran/pilih/{category_soal}/{jadwal}', [App\Http\Controllers\Guru\SoalController::class, 'matapelajaran'])->name('matapelajaran');
Route::get('/soal/semester/{mata_pelajaran_id}/{category_soal}', [App\Http\Controllers\Guru\SoalController::class, 'semester'])->name('soal-semester');
Route::get('/soal/{semester}/{category_soal}/{mata_pelajaran}', [App\Http\Controllers\Guru\SoalController::class, 'soal'])->name('soal-buat');
Route::post('/soal/store', [App\Http\Controllers\Guru\SoalController::class, 'store'])->name('soal-store');
Route::get('/soal/export', [App\Http\Controllers\Guru\SoalController::class, 'export'])->name('soal-export');
Route::post('/soal/import', [App\Http\Controllers\Guru\SoalController::class, 'import'])->name('soal-import');

Route::get('/soal/lihat/nilai/{semester}/{category_soal}/{mata_pelajaran}', [App\Http\Controllers\Guru\SoalController::class, 'lihat_nilai'])->name('lihat_nilai');
Route::post('/soal/lihat/nilai/{semester}/{category_soal}/{mata_pelajaran}', [App\Http\Controllers\Guru\SoalController::class, 'lihat_nilai_store'])->name('lihat_nilai_store');
// Route::post('/raport', [App\Http\Controllers\Guru\RaportController::class, 'raport_store'])->name('raport-raport');
Route::get('/raport/buat/{id}/{siswa_id}', [App\Http\Controllers\Guru\RaportController::class, 'raport_masuk'])->name('raport_masuk');



Route::get('/mata_pelajaran/siswa/{category_soal}/{jadwal}', [App\Http\Controllers\Guru\SoalController::class, 'siswa_index'])->name('siswa-soal');
Route::get('/soal/semester/siswa/{mata_pelajaran_id}/{category_soal}', [App\Http\Controllers\Guru\SoalController::class, 'siswa_semester'])->name('soal-siswa-semester');
Route::get('/categories/all2/{id}', [\App\Http\Controllers\Guru\Category_soalController::class, 'index2'])->name('categories.index2');
Route::get('/soal/siswa/{semester}/{category_soal}/{mata_pelajaran}/{jadwal}', [App\Http\Controllers\Guru\SoalController::class, 'siswa_soal'])->name('siswa_soal');


Route::post('/soal/siswa/sore', [App\Http\Controllers\Guru\SoalController::class, 'siswa_soal_store'])->name('siswa_soal_store');

Route::get('/categories/all/{id}', [\App\Http\Controllers\Guru\Category_soalController::class, 'index'])->name('categories.index');
Route::get('/categories/master/{id}', [\App\Http\Controllers\Guru\Category_soalController::class, 'master'])->name('categories.master');
Route::get('/categories/test', [\App\Http\Controllers\Guru\Category_soalController::class, 'test'])->name('categories.test');
Route::post('/categories/test', [\App\Http\Controllers\Guru\Category_soalController::class, 'store_test'])->name('client.test.store');
Route::get('/categories/filter', [\App\Http\Controllers\Guru\Category_soalController::class, 'filter'])->name('categories.filter');
Route::post('/categories/store', [\App\Http\Controllers\Guru\Category_soalController::class, 'store'])->name('categories.store');
Route::get('/categories/edit/{id}', [\App\Http\Controllers\Guru\Category_soalController::class, 'edit'])->name('categories.edit');
Route::post('/categories/update/{id}', [\App\Http\Controllers\Guru\Category_soalController::class, 'update'])->name('categories.update');
Route::get('/categories/destroy/{id}', [\App\Http\Controllers\Guru\Category_soalController::class, 'destroy'])->name('categories.destroy');


// Route::get('/pertanyaa', [\App\Http\Controllers\Guru\PertanyaanController::class, 'index'])->name('pertanyaan.index');
// Route::get('/pertanyaan/filter', [\App\Http\Controllers\Guru\PertanyaanController::class, 'filter'])->name('pertanyaan.filter');
// Route::post('/pertanyaan/store', [\App\Http\Controllers\Guru\PertanyaanController::class, 'store'])->name('pertanyaan.store');
// Route::get('/pertanyaan/edit/{id}', [\App\Http\Controllers\Guru\PertanyaanController::class, 'edit'])->name('pertanyaan.edit');
// Route::post('/pertanyaan/update/{id}', [\App\Http\Controllers\Guru\PertanyaanController::class, 'update'])->name('pertanyaan.update');
// Route::get('/pertanyaan/destroy/{id}', [\App\Http\Controllers\Guru\PertanyaanController::class, 'destroy'])->name('pertanyaan.destroy');


// Route::get('/optio', [\App\Http\Controllers\Guru\OptionController::class, 'index'])->name('option.index');
// Route::get('/option/filter', [\App\Http\Controllers\Guru\OptionController::class, 'filter'])->name('option.filter');
// Route::post('/option/store', [\App\Http\Controllers\Guru\OptionController::class, 'store'])->name('option.store');
// Route::get('/option/edit/{id}', [\App\Http\Controllers\Guru\OptionController::class, 'edit'])->name('option.edit');
// Route::post('/option/update/{id}', [\App\Http\Controllers\Guru\OptionController::class, 'update'])->name('option.update');
// Route::get('/option/destroy/{id}', [\App\Http\Controllers\Guru\OptionController::class, 'destroy'])->name('option.destroy');



// // Route::resource('tests', App\Http\Controllers\Guru\soalController::class);
// Route::get('tests', [App\Http\Controllers\Guru\soalController::class, 'index'])->name('tests.index');
// Route::post('tests', [App\Http\Controllers\Guru\soalController::class, 'store'])->name('tests.store');

// Route::resource('results', App\Http\Controllers\Guru\ResultsController::class);

// Route::resource('questions_options',  App\Http\Controllers\Guru\QuestionsOptionsController::class);
// Route::resource('questions', App\Http\Controllers\Guru\QuestionsController::class);

// Route::resource('topics', App\Http\Controllers\Guru\TopicsController::class);

Route::get('/user', function () {
    return view('user');
})->middleware('auth:user');

Route::get('/siswasdsdsd', function () {
    return view('siswa');
});
