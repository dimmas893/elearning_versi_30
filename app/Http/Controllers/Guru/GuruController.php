<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Absen;
use App\Models\Absens;
use App\Models\Jadwal;
use App\Models\Materi;
use App\Models\Nilai_tugas;
use App\Models\Nilai_Ujian;
use App\Models\Nilai_Ulangan;
use App\Models\Pertemuan;
use App\Models\Raport;
use App\Models\Ruangan;
use App\Models\Semester;
use App\Models\Siswa;
use App\Models\Tugas;
use App\Models\Ujian;
use App\Models\Ulangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GuruController extends Controller
{
    public function index()
    {
        return view('frontend.guru.index');
    }

    public function jadwalMengajar()
    {
        $jadwals = Jadwal::with('mata_pelajaran', 'hari', 'guru')->where('guru_id', Auth::guard('guru')->user()->id)->get();

        return view('frontend.guru.jadwal', [
            'jadwals' => $jadwals,
        ]);
    }

    // public function semua_tugas(Request $request)
    // {
    //     $semua_tugas = Tugas::with('jadwal')->where('jadwal_id', $request->jadwal_id)->get();
    //     return view('frontend.guru.semua_tugas', compact('semua_tugas'));
    // }
    public function raport_create(Request $request)
    {
        // $datajadwal = Jadwal::with('kelas')->where('id', $request->jadwal_id)->first();
        $dataSiswa = Ruangan::all();


        foreach ($dataSiswa as $p) {

            $raport =   Raport::create([
                'nilai_tugas' => null,
                'nilai_ulangan' => null,
                'nilai_ujian' => null,
                'nilai_raport' => null,
                'semester' => $request->semester,
                'siswa_id' => $p->siswa_id,
                'kelas_id' => $p->kelas_id,
                'tahun_ajaran' => $request->tahun_ajaran,
            ]);
            // dd($raport);
        }



        return back()->with('success', 'tugas berhasil di buat');
    }


 



    public function buat_absen(Request $request)
    {
        $datajadwal = Jadwal::with('kelas')->where('id', $request->jadwal_id)->first();
        $dataSiswa = Ruangan::where('kelas_id', $datajadwal->kelas_id)->get();

        $hariini = \Carbon\Carbon::now()->format('Y-m-d');
        // $absen = Absens::where('jadwal_id', $datajadwal->id)->where('kelas_id', $datajadwal->kelas_id)->first();

        // if ($absen->pertemuan > $request->pertemuan) {
        // for ($i = 1; $i; $i++) {
        $i = Pertemuan::where('jadwal_id', $datajadwal->id)->where('kelas_id', $request->kelas_id)->where('guru_id', Auth::guard('guru')->user()->id)->count('jadwal_id');
        $cek = Pertemuan::where('jadwal_id', $datajadwal->id)->where('kelas_id', $request->kelas_id)->where('guru_id', Auth::guard('guru')->user()->id)->Where('tanggal', $hariini)->count();
        if ($cek < 1) {
            $pertemuan = [
                'kelas_id' => $request->kelas_id,
                'tanggal' => $request->tanggal,
                'guru_id' =>  Auth::guard('guru')->user()->id,
                'jadwal_id' => $datajadwal->id,
                'pertemuan' => $i + 1,
                'semester_id' => $request->semester_id,
                'tahun_ajaran' => $request->tahun_ajaran
            ];
            $create = Pertemuan::create($pertemuan);
            
        
        foreach ($dataSiswa as $p) {
            Absens::create([
                'status' => null,
                'siswa_id' => $p->siswa_id,
                    'jadwal_id' => $datajadwal->id,
                'pertemuan' => $create->pertemuan,
                'semester' => $request->semester,
                    'kelas_id' => $create->kelas_id,
                    'tanggal' => $create->tanggal,
                    'tahun_ajaran' => $request->tahun_ajaran,
                    'guru_id' =>  Auth::guard('guru')->user()->id
                ]);
        }
            return back()->with('success', 'absen berhasil di buat');
        }
        return back()->with('error', 'anda hari ini sudah membuat absens');
        // return back()->with('error', 'anda sudah membuat absens');
    }

    public function materi(Request $request)
    { 
        // {

        //     if ($request->file('file_or_link')) {
        //         //simpan foto produk yang di upload ke direkteri public/storage/file_or_linkproduct
        //         $file = $request->file('file_or_link')->store('images', 'public');

        //         $materi = [
        //             'judul' => $request->judul,
        //             'type' => $request->type,
        //             'description' => $request->description,
        //             'file_or_link' => $file,
        //             'jadwal_id' => $request->jadwal_id,
        //             'tanggal' => $request->tanggal,
        //             'pertemuan' => $request->pertemuan,
        //             'kelas_id' => $request->kelas_id,
        //             'tahun_ajaran' => $request->tahun_ajaran,
        //             'semester' => $request->semester
        //         ];

        //         Materi::create($materi);
        //         return back()->with('success', 'Materi berhasil di buat');
        //     }

        //     $materi = [
        //         'judul' => $request->judul,
        //         'type' => $request->type,
        //         'description' => $request->description,
        //         'file_or_link' => $request->file_or_link,
        //         'jadwal_id' => $request->jadwal_id,
        //         'tanggal' => $request->tanggal,
        //         'pertemuan' => $request->pertemuan,
        //         'kelas_id' => $request->kelas_id,
        //         'tahun_ajaran' => $request->tahun_ajaran,
        //         'semester' => $request->semester
        //     ];

        //     if ($materi) {
        //         Materi::create($materi);
        //         return back()->with('success', 'Materi berhasil di buat');
        //     }

        //     return back()->with('error', 'Materi gagal di buat');
        // }
    }

    public function create($id)
    {
        $jadwalId = decrypt($id);
        $jadwal = Jadwal::where('id', $jadwalId)
            ->where('guru_id', Auth::guard('guru')->user()->id)
            ->first();

        return view('frontend.guru.meteri', compact('jadwal'));
    }

    // public function cari_tugas_filter(Request $request, $id)
    // {
    //     $semester = Semester::all();

    //     // $jadwal = Jadwal::with(['kelas'], ['guru'], ['mata_pelajaran'])->where('id', decrypt($id))->first();

    //     $jadwal = Jadwal::with(['kelas'], ['guru'], ['mata_pelajaran'])->where('id', decrypt($id))->first();
    //     $semua_tugas_tampil = DB::table('nilai_tugas')
    //         ->leftjoin('tugas', 'nilai_tugas.tugas_id', '=', 'tugas.id')
    //         ->leftjoin('siswa', 'nilai_tugas.siswa_id', '=', 'siswa.id')
    //         ->leftjoin('kelas', 'nilai_tugas.kelas_id', '=', 'kelas.id')
    //         ->leftjoin('semester', 'nilai_tugas.semester', '=', 'semester.id')
    //         ->select(
    //             'siswa.name as siswa_name',
    //             'siswa.nisn as siswa_nisn',
    //             'kelas.kelas as kelas',
    //             'tugas.judul as judul',
    //             'tugas.type as type',
    //             'tugas.pengumpulan as pengumpulan',
    //             'tugas.file_or_link as file_or_link',
    //             'tugas.description as description',
    //             'nilai_tugas.jawaban_siswa as jawaban_siswa',
    //             'nilai_tugas.nilai as nilai',
    //             'nilai_tugas.semester as semester',
    //             'nilai_tugas.komentar_guru as komentar_guru',
    //             'nilai_tugas.tanggal as tanggal_tugas',
    //             'nilai_tugas.pertemuan as pertemuan',
    //             'nilai_tugas.tahun_ajaran as tahun_ajaran',
    //             'nilai_tugas.created_at as created_at',
    //             'nilai_tugas.id as id',
    //         'semester.name as semester',
    //         )
    //         ->where('nilai_tugas.jadwal_id', $jadwal->id)
    //         ->where('nilai_tugas.semester', 'like', '%' . $request->semester . '%')
    //         ->where('nilai_tugas.tahun_ajaran', 'like', '%' . $request->tahun_ajaran . '%')
    //         ->groupBy(
    //             'siswa.name',
    //             'siswa.nisn',
    //             'kelas.kelas',
    //             'tugas.judul',
    //             'tugas.type',
    //             'tugas.file_or_link',
    //             'tugas.description',
    //             'nilai_tugas.jawaban_siswa',
    //             'nilai_tugas.nilai',
    //             'nilai_tugas.semester',
    //             'nilai_tugas.komentar_guru',
    //             'nilai_tugas.tanggal',
    //             'nilai_tugas.pertemuan',
    //             'nilai_tugas.tahun_ajaran',
    //             'tugas.pengumpulan',
    //             'nilai_tugas.created_at',
    //             'nilai_tugas.id',
    //         'semester.name',
    //         )
    //         ->limit(10)
    //         ->orderBy('nilai', 'desc')
    //         ->get();

    //     return view('frontend.guru.raport.cari_tugas_filter', compact('semua_tugas_tampil', 'jadwal', 'semester'));
    // }

    // public function cari_materi_filter(Request $request, $id)
    // {
    //     $semester = Semester::all();
    //     $jadwal = Jadwal::with(['kelas'], ['guru'], ['mata_pelajaran'])->where('id', decrypt($id))->first();
    //     $cari_materi_filter = DB::table('materi')
    //         ->leftjoin('semester', 'materi.semester', '=', 'semester.id')
    //         ->select(
    //             'materi.judul as judul',
    //             'materi.type as type',
    //             'materi.file_or_link as file_or_link',
    //             'materi.description as description',
    //             'materi.pertemuan as pertemuan',
    //             // 'materi.semester as semester',
    //             'materi.tanggal as tanggal',
    //             'materi.tahun_ajaran as tahun_ajaran',
    //             'materi.kelas_id as kelas_id',
    //         'semester.name as semester',
    //         )
    //         ->where('materi.jadwal_id', $jadwal->id)
    //         ->where('materi.semester', 'like', '%' . $request->semester . '%')
    //         ->where('materi.tahun_ajaran', 'like', '%' . $request->tahun_ajaran . '%')
    //         ->groupBy(
    //             'materi.judul',
    //             'materi.type',
    //             'materi.file_or_link',
    //             'materi.description',
    //             'materi.pertemuan',
    //             // 'materi.semester',
    //             'materi.tanggal',
    //             'materi.tahun_ajaran',
    //             'materi.kelas_id',
    //         'semester.name',
    //         )
    //         ->limit(10)
    //         ->orderBy('semester', 'desc')
    //         ->get();

    //     return view('frontend.guru.materi.cari_materi_filter', compact('cari_materi_filter', 'jadwal', 'semester'));
    // }

    // public function cari_ulangan_filter(Request $request, $id)
    // {
    //     $semester = Semester::all();
    //     $jadwal = Jadwal::with(['kelas'], ['guru'], ['mata_pelajaran'])->where('id', decrypt($id))->first();
    //     $cari_ulangan_filter = DB::table('nilai_ulangan')
    //         ->leftjoin('ulangan', 'nilai_ulangan.ulangan_id', '=', 'ulangan.id')
    //         ->leftjoin('semester', 'nilai_ulangan.semester', '=', 'semester.id')
    //         ->leftjoin(
    //             'siswa',
    //             'nilai_ulangan.siswa_id',
    //             '=',
    //             'siswa.id'
    //         )
    //         ->leftjoin(
    //             'kelas',
    //             'nilai_ulangan.kelas_id',
    //             '=',
    //             'kelas.id'
    //         )
    //         ->where('nilai_ulangan.jadwal_id', $jadwal->id)
    //         ->where('nilai_ulangan.semester', 'like', '%' . $request->semester . '%')
    //         ->where('nilai_ulangan.tahun_ajaran', 'like', '%' . $request->tahun_ajaran . '%')
    //         ->where('guru_id', Auth::guard('guru')->user()->id)
    //         ->select(
    //             'siswa.name as siswa_name',
    //             'siswa.nisn as siswa_nisn',
    //             'kelas.kelas as kelas',
    //             'ulangan.judul as judul_ulangan',
    //             'ulangan.type as type',
    //             'ulangan.pengumpulan as pengumpulan',
    //             'ulangan.file_or_link as file_or_link',
    //             'ulangan.description as description',
    //             'nilai_ulangan.jawaban_siswa as jawaban_siswa',
    //             'nilai_ulangan.nilai as nilai',
    //             'nilai_ulangan.semester as semester',
    //             'nilai_ulangan.komentar_guru as komentar_guru',
    //             'nilai_ulangan.tanggal as tanggal_ulangan',
    //             'nilai_ulangan.pertemuan as pertemuan',
    //             'nilai_ulangan.tahun_ajaran as tahun_ajaran',
    //             'nilai_ulangan.created_at as created_at',
    //             'nilai_ulangan.id as id',
    //         'semester.name as semester',
    //         )
    //         ->groupBy(
    //             'siswa.name',
    //             'siswa.nisn',
    //             'kelas.kelas',
    //             'ulangan.judul',
    //             'ulangan.type',
    //             'ulangan.file_or_link',
    //             'ulangan.description',
    //             'nilai_ulangan.jawaban_siswa',
    //             'nilai_ulangan.nilai',
    //             'nilai_ulangan.semester',
    //             'nilai_ulangan.komentar_guru',
    //             'nilai_ulangan.tanggal',
    //             'nilai_ulangan.pertemuan',
    //             'nilai_ulangan.tahun_ajaran',
    //             'ulangan.pengumpulan',
    //             'nilai_ulangan.created_at',
    //             'nilai_ulangan.id',
    //         'semester.name',
    //         )
    //         ->limit(10)
    //         ->orderBy('nilai', 'desc')
    //         ->get();

    //     return view('frontend.guru.ulangan.cari_ulangan_filter', compact('cari_ulangan_filter', 'jadwal', 'semester'));
    // }

    // public function cari_ujian_filter(Request $request, $id)
    // {
    //     $semester = Semester::all();
    //     $jadwal = Jadwal::with(['kelas'], ['guru'], ['mata_pelajaran'])->where('id', decrypt($id))->first();
    //     $cari_ujian_filter = DB::table('nilai_ujian')
    //     ->leftjoin('ujian', 'nilai_ujian.ujian_id', '=', 'ujian.id')
    //     ->leftjoin('semester', 'nilai_ujian.semester', '=', 'semester.id')
    //     ->leftjoin(
    //         'siswa',
    //         'nilai_ujian.siswa_id',
    //         '=',
    //         'siswa.id'
    //     )
    //         ->leftjoin('kelas', 'nilai_ujian.kelas_id', '=', 'kelas.id')
    //         ->where(
    //             'nilai_ujian.jadwal_id',
    //             $jadwal->id
    //         )
    //         ->where('nilai_ujian.jadwal_id', $jadwal->id)
    //         ->where('nilai_ujian.semester', 'like', '%' . $request->semester . '%')
    //         ->where('nilai_ujian.tahun_ajaran', 'like', '%' . $request->tahun_ajaran . '%')
    //         ->where('guru_id', Auth::guard('guru')->user()->id)
    //         ->select(
    //         'siswa.name as siswa_name',
    //         'siswa.nisn as siswa_nisn',
    //         'kelas.kelas as kelas',
    //         'ujian.judul as judul',
    //         'ujian.type as type',
    //         'ujian.pengumpulan as pengumpulan',
    //         'ujian.file_or_link as file_or_link',
    //         'ujian.description as description',
    //         'nilai_ujian.jawaban_siswa as jawaban_siswa',
    //         'nilai_ujian.nilai as nilai',
    //         // 'nilai_ujian.semester as semester',
    //         'nilai_ujian.komentar_guru as komentar_guru',
    //         'nilai_ujian.tanggal as tanggal_ujian',
    //         'nilai_ujian.pertemuan as pertemuan',
    //         'nilai_ujian.tahun_ajaran as tahun_ajaran',
    //         'nilai_ujian.created_at as created_at',
    //         'nilai_ujian.id as id',
    //         'semester.name as semester',
    //     )
    //         ->groupBy(
    //         'siswa.name',
    //         'siswa.nisn',
    //         'kelas.kelas',
    //         'ujian.judul',
    //         'ujian.type',
    //         'ujian.file_or_link',
    //         'ujian.description',
    //         'nilai_ujian.jawaban_siswa',
    //         'nilai_ujian.nilai',
    //         // 'nilai_ujian.semester',
    //         'nilai_ujian.komentar_guru',
    //         'nilai_ujian.tanggal',
    //         'nilai_ujian.pertemuan',
    //         'nilai_ujian.tahun_ajaran',
    //         'ujian.pengumpulan',
    //         'nilai_ujian.created_at',
    //         'nilai_ujian.id',
    //         'semester.name',
    //         )
    //         ->limit(10)
    //         ->orderBy('nilai', 'desc')
    //         ->get();

    //     return view('frontend.guru.ujian.cari_ujian_filter', compact('cari_ujian_filter', 'jadwal', 'semester'));
    // }

    public function masuk(Request $request, $id)
    {
        $jadwal = Jadwal::with(['kelas'], ['guru'], ['mata_pelajaran'])->where('id', decrypt($id))->first();
        $absencheck = Absens::with('siswa')->where('jadwal_id', $jadwal->id)->where('status', null)->get();
        $absencheckget = Absens::with('siswa')->where('jadwal_id', $jadwal->id)->where('status', null)->get();

        $checkabsen = Absens::where('jadwal_id', $jadwal->id)->first();

        $semester = Semester::all();

        // Jika waktu pada jadwal sesuai maka jalankan code dibawah 
        if (\Carbon\Carbon::now('Asia/Jakarta')->format('H:i') >= $jadwal->jam_masuk && \Carbon\Carbon::now('Asia/Jakarta')->format('H:i') <= $jadwal->jam_keluar) {
            $hariini = \Carbon\Carbon::now()->format('Y-m-d');
            $absens = Absens::with('siswa', 'jadwal')->where('jadwal_id', $jadwal->id)->get();
            $absen_izin_total = Absens::with('siswa', 'jadwal')->where('jadwal_id', $jadwal->id)->where('status', 'izin')->count('siswa_id');
            $absen_alpha_total = Absens::with('siswa', 'jadwal')->where('jadwal_id', $jadwal->id)->where('status', 'alpa')->count('siswa_id');
            $absen_sakit_total = Absens::with('siswa', 'jadwal')->where('jadwal_id', $jadwal->id)->where('status', 'sakit')->count('siswa_id');



            $counthariini_sakit = Absens::with('siswa', 'jadwal')->where('jadwal_id', $jadwal->id)->where('status', 'sakit')->where('created_at', $hariini)->count('siswa_id');
            $counthariini_alpa = Absens::with('siswa', 'jadwal')->where('jadwal_id', $jadwal->id)->where('status', 'alpa')->where('created_at', $hariini)->count('siswa_id');
            $counthariini_izin = Absens::with('siswa', 'jadwal')->where('jadwal_id', $jadwal->id)->where('status', 'izin')->where('created_at', $hariini)->count('siswa_id');
            $semua_materi_tampil = Materi::with('jadwal')->where('jadwal_id', $jadwal->id)->get();
            $semua_materi_tampil_count = Materi::with('jadwal')->where('jadwal_id', $jadwal->id)->count();



            $materi_hari_ini = Materi::with('jadwal')->where('jadwal_id', $jadwal->id)->where('tanggal', $hariini)->count();


            $hadir_count = Absens::with('jadwal')->where('jadwal_id', $jadwal->id)->where('status', 'hadir')->where('tanggal', $hariini)->count('siswa_id');


            $count = Ruangan::with('siswa')->where('kelas_id', $jadwal->kelas->id)->count('siswa_id');
            $sakit = Absens::with('jadwal')->where('jadwal_id', $jadwal->id)->where('status',  'sakit')->where('tanggal', $hariini)->count('siswa_id');
            $izin = Absens::with('jadwal')->where('jadwal_id', $jadwal->id)->where('status',  'izin')->where('tanggal', $hariini)->count('siswa_id');
            $alpa = Absens::with('jadwal')->where('jadwal_id', $jadwal->id)->where('status', 'alpa')->where('tanggal', $hariini)->count('siswa_id');

            $pp = Absens::with('jadwal')->where('jadwal_id', $jadwal->id)->where('status',  'hadir')->where('tanggal', $hariini)->count('siswa_id');

            $hitung_absen = Absens::with('jadwal')->where('jadwal_id', $jadwal->id)->where('status', '!=', 'hadir')->where('tanggal', $hariini)->count('siswa_id');


            $materi_hari_ini_tampil = Materi::with('jadwal')->where('jadwal_id', $jadwal->id)->where('tanggal', $hariini)->get();

            $total = $sakit + $izin + $alpa + $pp;

            $hadir = Absens::with('jadwal')->where('jadwal_id', $jadwal->id)->where('tanggal', $hariini)->get();
            $siswa_belum_absens = Absens::with('siswa')->where('jadwal_id', $jadwal->id)->where('status', null)->where('tanggal', $hariini)->get();



            $total_hadir = $count - $total;
            $total_hadir_siswa = $count;
            $absens_semester = DB::table('absens')
                ->select(
                    'absens.semester as semesters',
                    'absens.tahun_ajaran as tahun_ajaran',
                )
                ->groupBy('absens.semester', 'absens.tahun_ajaran')
                // ->limit(10)
                ->orderBy('semester', 'desc')
                ->distinct()
                ->get();



            $check = Absens::where('jadwal_id', $jadwal->id)->count('siswa_id');


            $cek = Pertemuan::where(
                'jadwal_id',
                $jadwal->id
            )->where('kelas_id', $jadwal->kelas_id)->where('guru_id', Auth::guard('guru')->user()->id)->Where('tanggal', $hariini)->count();
            $cekcok = raport::with('semes')->where('kelas_id', $jadwal->kelas_id)->where('tahun_ajaran', \Carbon\Carbon::now('Asia/Jakarta')->format('Y'))->orderBy('id', 'desc')->limit(1)->first();

            $pertemuan = Pertemuan::where(
                'jadwal_id',
                $jadwal->id
            )->where('kelas_id', $jadwal->kelas_id)->where('guru_id', Auth::guard('guru')->user()->id)->count();
            // $cek = Pertemuan::where('jadwal_id', $jadwal->id)->where('kelas_id', $jadwal->kelas_id)->where('guru_id', Auth::guard('guru')->user()->id)->count();

            return view('frontend.guru.kelas', compact(
                'absencheck',
                'pertemuan',
                'cekcok',
                'jadwal',
                'absens',
                'count',
                'absen_alpha_total',
                'absen_izin_total',
                'absen_sakit_total',
                'counthariini_sakit',
                'counthariini_alpa',
                'counthariini_izin',
                'hariini',
                'hadir',
                'total_hadir_siswa',
                'pp',
                'materi_hari_ini',
                'materi_hari_ini_tampil',
                'semua_materi_tampil',
                'check',
                'hadir_count',
                'total_hadir',
                'hitung_absen',
                'absencheckget',
                'checkabsen',
                'siswa_belum_absens',
                'semua_materi_tampil_count',
                'semester',
                'cek'
            ));
        }

        // Jika waktu pada jadwal tidak sesuai return back
        return back();
    }

    public function storeAbsen(Request $request, $id)
    {
        $booking = Absens::findOrFail($id);
        $booking['status'] = $request->status;
        if ($booking) {
            $booking->save();
            return back()->with('success', 'anda berhasil absen');
        }
        return back()->with('error', 'gagal');
    }

    public function storeAbsenget($id)
    {

        // $jadwal = Jadwal::with(['kelas'], ['guru'], ['mata_pelajaran'])->where('id', decrypt($id))->first();
        $absens = Absens::FindOrFail($id);
        // return response()->json($absens);
        return view('frontend.guru.absens', compact('absens'));
    }

    public function kasih_nilai($id)
    {
        $nilai_tugas =  Nilai_tugas::where('tugas_id', $id)->get();
        return view('frontend.guru.ambil_nilai', compact('nilai_tugas'));
    }

    public function get_jawaban_siswa_nilai(Request $request, $id)
    {
        $nilai_tugas_siswa = Nilai_tugas::FindOrFail($id);
        return view('frontend.guru.jawaban', compact('nilai_tugas_siswa'));
    }

    public function jawaban_siswa_nilai(Request $request, $id)
    {
        $booking = Nilai_tugas::findOrFail($id);
        $booking['nilai'] = $request->nilai;
        $booking['komentar_guru'] = $request->komentar_guru;
        $booking->save();
        return back()->with('success', 'berhasi mengirim nilai');
    }






    // public function create_absensi($id)
    // {
    //     $jadwal = Jadwal::with('hari')->findOrFail(decrypt($id));
    //     $kelasActive = Jadwal::with('guru')->where('guru_id', Auth::guard('guru')->user()->id)->where('hari_id', 5)->get();
    //     $absen = Absen::where('guru_id', Auth::guard('guru')->user()->id)
    //         ->where('jadwal_id', $jadwal->id)
    //         ->whereDate('created_at', now())
    //         ->first();
    //     return view('frontend.guru.absensi-create', compact('kelasActive', 'jadwal', 'absen'));
    // }

    // public function store_absensi(Request $request)
    // {
    //     $jadwal_id = decrypt(request('jadwal'));

    //     request()->validate([
    //         'pertemuan' => 'required'
    //     ]);

    //     $absen = Absen::create([
    //         'jadwal_id' => $jadwal_id,
    //         'pertemuan' => request('pertemuan'),
    //         'rangkuman' => request('rangkuman'),
    //         'berita_acara' => request('berita_acara')
    //     ]);

    //     $mahasiswas = Siswa::where('ruangan_id', request('kelas'))->get();

    //     foreach ($mahasiswas as $mahasiswa) {
    //         Absen::create([
    //             'jadwal_id' => $jadwal_id,
    //             'parent' => $absen->id,
    //             'siswa_id' => $mahasiswa->id,
    //             'pertemuan' => $absen->pertemuan,
    //         ]);
    //     }

    //     session()->flash('success', 'Berhasil membuat absen hari ini');
    //     return redirect(route('kelas-masuk', request('jadwal')));
    // }
}
