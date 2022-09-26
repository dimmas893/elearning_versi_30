<?php

namespace App\Http\Controllers\Guru;

use App\Exports\SoalExport;
use App\Http\Controllers\Controller;
use App\Imports\Soalimport;
use App\Models\Category_soal;
use App\Models\hasil_nilai;
use App\Models\Hasil_soal;
use App\Models\Jadwal;
use App\Models\Kelas;
use App\Models\master_category_soal;
use App\Models\MataPelajaran;
use App\Models\Semester;
use App\Models\Soal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Calculation\MathTrig\Sum;

set_time_limit(10800);

class SoalController extends Controller
{
    public function index($category_soal, $jadwal)
    {
        // $jadwal = Jadwal::where('id', decrypt($jadwal))->first();
        $jadwal = Jadwal::where('id', decrypt($jadwal))->firstOrFail();
        $category_soal_master = master_category_soal::where('id', decrypt($category_soal))->firstOrFail();
        $category_soal = Category_soal::with('semester')->where('master_category_soal_id', $category_soal_master->id)->get();
        // $mata_pelajaran = MataPelajaran::where('id', $jadwal->mata_pelajaran_id)->get();
        $semester = Semester::all();

        $kelas = Kelas::all();
        // $soal = Soal::with('guru')->get();
        return view('frontend.guru.category_soal.index', compact('kelas', 'category_soal', 'jadwal', 'category_soal_master', 'semester'));
    }
    

    public function matapelajaran($category_soal, $jadwal)
    {
        // $jadwal = Jadwal::where('id', decrypt($jadwal))->first();
        $category_soalcategory_soal = Category_soal::with('kelas', 'semester')->where('id', decrypt($category_soal))->firstOrFail();
        $jadwal = Jadwal::where('id', decrypt($jadwal))->firstOrFail();
        $mata_pelajaran = MataPelajaran::where('id', $jadwal->mata_pelajaran_id)->get();

        $kelas = Kelas::all();
        // $soal = Soal::with('guru')->get();
        return view('frontend.guru.category_soal.category_soal', compact('kelas', 'category_soal', 'jadwal', 'mata_pelajaran', 'category_soalcategory_soal'));
    }

    public function export(Request $request)
    {
        // return Excel::download(new SoalExport(), 'soal.xlsx');


        $guru_id = Auth::guard('guru')->user()->id;
        $kelas_id = $request->kelas_id;
        $category_soal_id = $request->category_soal_id;
        $mata_pelajaran_id = $request->mata_pelajaran_id;
        // $tahun_ajaran = \Carbon\Carbon::now('Asia/Jakarta')->format('Y');
        $semester_id = $request->semester_id;
        // return (new SoalExport($guru_id, $kelas_id, $category_soal_id, $mata_pelajaran_id, $tahun_ajaran, $semester_id))->download('invoices.xlsx');

        return Excel::download(new SoalExport($guru_id, $kelas_id, $category_soal_id, $mata_pelajaran_id, $semester_id), 'soal.xlsx');
    }

    public function import(Request $request)
    {
        $guru_id = Auth::guard('guru')->user()->id;
        $kelas_id = $request->kelas_id;
        $category_soal_id = $request->category_soal_id;
        $mata_pelajaran_id = $request->mata_pelajaran_id;
        $tahun_ajaran = $request->tahun_ajaran;
        $semester_id = $request->semester_id;
        $tanggal = $request->tanggal;
        Excel::import(new Soalimport($guru_id, $kelas_id, $category_soal_id, $mata_pelajaran_id, $tahun_ajaran, $semester_id, $tanggal), request()->file('file'));

        return back();
    }


    public function semester($mata_pelajaran_id, $category_soal)
    {
        $mata_pelajaran = MataPelajaran::where('id', decrypt($mata_pelajaran_id))->firstOrFail();
        $category_soal = Category_soal::where('id', decrypt($category_soal))->firstOrFail();
        $semester = Semester::where('id', $category_soal->semester_id)->get();

        return view('frontend.guru.soal.semester', compact('mata_pelajaran', 'category_soal', 'semester'));
    }


    public function soal($semester, $category_soal, $mata_pelajaran_id)
    {
        // $semestersemester = Semester::FindOrFail(decrypt($semester));

        $semestersemester = Semester::where('id', decrypt($semester))->firstOrFail();
        $category_soal = Category_soal::where('id', decrypt($category_soal))->firstOrFail();
        $mata_pelajaran = MataPelajaran::where('id', decrypt($mata_pelajaran_id))->firstOrFail();
        $soal = Soal::with('guru', 'mata_pelajaran', 'kelas')->where('tahun_ajaran', \Carbon\Carbon::now('Asia/Jakarta')->format('Y'))->where('semester_id', $semestersemester->id)->where('category_soal_id', $category_soal->id)->where('kelas_id', $category_soal->kelas_id)->where('mata_pelajaran_id', $mata_pelajaran->id)->where('guru_id', Auth::guard('guru')->user()->id)->get();

        return view('frontend.guru.soal.index', compact('semestersemester', 'category_soal', 'mata_pelajaran', 'soal'));
    }

    public function store(Request $request)
    {
        $create = [
            'soal' => $request->soal,
            // 'file' => $request->file('file')->store('assets/soal', 'public'),
            'opsi_a' => $request->opsi_a,
            'opsi_b' => $request->opsi_b,
            'opsi_c' => $request->opsi_c,
            'opsi_d' => $request->opsi_d,
            'jawaban' => $request->jawaban,
            'guru_id' => $request->guru_id,
            'tahun_ajaran' => $request->tahun_ajaran,
            'kelas_id' => $request->kelas_id,
            'mata_pelajaran_id' => $request->mata_pelajaran_id,
            'category_soal_id' => $request->category_soal_id,
            'semester_id' => $request->semester_id,
        ];

        $soal =  Soal::create($create);
        // dd($soal);
        return back()->with('success', 'berhasil menambah soal');
        // return view('frontend.guru.soal.index', compact('mata_pelajaran', 'soal', 'category_soal'))->with('success', 'berhasil menambahkan soal');
    }



    // siswa
    public function siswa_index($category_soal, $jadwal)
    {
        // $jadwal = Jadwal::where('id', decrypt($jadwal))->first();
        $category_soal = Category_soal::where('id', decrypt($category_soal))->firstOrFail();
        $jadwal = Jadwal::where('id', decrypt($jadwal))->firstOrFail();
        $mata_pelajaran = MataPelajaran::where('id', $jadwal->mata_pelajaran_id)->get();

        $kelas = Kelas::all();
        // $soal = Soal::with('guru')->get();
        return view('frontend.siswa.soal.mata_pelajaran', compact('mata_pelajaran', 'kelas', 'category_soal', 'jadwal'));
    }

    public function siswa_semester($mata_pelajaran_id, $category_soal)
    {
        $mata_pelajaran = MataPelajaran::where('id', decrypt($mata_pelajaran_id))->firstOrFail();
        $category_soal = Category_soal::where('id', decrypt($category_soal))->firstOrFail();
        $semester = Semester::where('id', $category_soal->semester_id)->get();

        return view('frontend.siswa.soal.semester', compact('mata_pelajaran', 'category_soal', 'semester'));
    }


    public function siswa_soal($semester, $category_soal, $mata_pelajaran_id, $jadwal)
    {
        // $semestersemester = Semester::FindOrFail(decrypt($semester));

        $semestersemester = Semester::where('id', decrypt($semester))->firstOrFail();
        $category_soal = Category_soal::where('id', decrypt($category_soal))->firstOrFail();
        $mata_pelajaran = MataPelajaran::where('id', decrypt($mata_pelajaran_id))->firstOrFail();
        $jadwal = Jadwal::where('id', decrypt($jadwal))->firstOrFail();

        
        $cek = Hasil_soal::where('semester_id', $semestersemester->id)->where('category_soal_id', $category_soal->id)->where('kelas_id', $category_soal->kelas_id)->where('mata_pelajaran_id', $mata_pelajaran->id)->where('siswa_id', Auth::guard('siswa')->user()->id)->count('id');
        $soal = DB::table('soal')
            ->leftjoin('kelas', 'soal.kelas_id', '=', 'kelas.id')
            ->leftjoin('mata_pelajaran', 'soal.mata_pelajaran_id', '=', 'mata_pelajaran.id')
            ->leftjoin('semester', 'soal.semester_id', '=', 'semester.id')
            ->where('tahun_ajaran', \Carbon\Carbon::now('Asia/Jakarta')->format('Y'))
            ->where('semester_id', $semestersemester->id)
            ->where('category_soal_id', $category_soal->id)
            ->where('kelas_id', $category_soal->kelas_id)
            ->where('mata_pelajaran_id', $mata_pelajaran->id)
            ->select(
                'soal.soal as soal',
                'soal.opsi_a as opsi_a',
                'soal.opsi_b as opsi_b',
                'soal.opsi_c as opsi_c',
                'soal.opsi_d as opsi_d',
                'soal.id as soal_idid',
                'soal.jawaban as jawaban',
                'soal.tanggal as tanggal',
                'semester.name as semester',
                'kelas.kelas as kelas',
                'mata_pelajaran.name as mata_pelajaran',
                // 'nilai_tugas.id as id_nilai',
                // 'nilai_tugas.status as tugas_status',

                DB::raw('COUNT(tanggal) as total'),
            )
            ->groupBy('soal.soal', 'soal.id', 'soal.opsi_a', 'soal.opsi_b', 'soal.opsi_c', 'soal.opsi_d', 'soal.jawaban', 'semester.name', 'kelas.kelas', 'mata_pelajaran.name', 'soal.tanggal')
            // ->limit(10)
            ->orderBy('tanggal', 'desc')
            // ->distinct()
            ->get();
        // $soal = Soal::with('guru', 'mata_pelajaran', 'kelas')->get();

        $hasil_soal = Hasil_nilai::where('semester_id', $semestersemester->id)->where('category_soal_id', $category_soal->id)->where('kelas_id', $category_soal->kelas_id)->where('mata_pelajaran_id', $mata_pelajaran->id)->where('siswa_id', Auth::guard('siswa')->user()->id)->first();
        $hasil_soal_salah = Hasil_soal::where('semester_id', $semestersemester->id)->where('category_soal_id', $category_soal->id)->where('kelas_id', $category_soal->kelas_id)->where('mata_pelajaran_id', $mata_pelajaran->id)->where('siswa_id', Auth::guard('siswa')->user()->id)->where('hasil', 0)->count('hasil');
        $hasil_soal_benar = Hasil_soal::where('semester_id', $semestersemester->id)->where('category_soal_id', $category_soal->id)->where('kelas_id', $category_soal->kelas_id)->where('mata_pelajaran_id', $mata_pelajaran->id)->where('siswa_id', Auth::guard('siswa')->user()->id)->where('hasil', 1)->count('hasil');

        return view('frontend.siswa.soal.index', compact('semestersemester', 'category_soal', 'mata_pelajaran', 'soal', 'cek', 'hasil_soal', 'hasil_soal_benar', 'hasil_soal_salah', 'jadwal'));
    }

    public function siswa_soal_store(Request $request)
    {
        // $hasil_soal = Hasil_soal::where('soal_id', $request->soal_id)->firstOrFail();
        // $soal = Soal::where('id', $request->soal_id)->firstOrFail();
        // $hasil_soal = Hasil_soal::where('soal_id', $request->soal_id)->first();
        // // if ($hasil_soal->id !== $request->soal_id) {
        // // dd($request->all());
        // //     return 'blm diisi';
        // // }
        // // if ($hasil_soal->id == $request->soal_id) {
        // //     return 'sudah diisi';
        // // }

        // if ($hasil_soal->soal_id == $soal->id) {
        //     return back()->with('success', 'sudah jawab');
        // }
        // for ($i = 0; $i < 40; $i++) {

            $jumlahSoal = $request->jumlah_soal;

// dd($request);
        $i = 0;
        for ($i = 0; $i < $jumlahSoal; $i++) {

            if ($request['soal' . $i][0] == $request['soal' . $i][2]) {
                $hasil = 1;
                $create = [
                    'soal_id' => $request['soal' . $i][1],
                    'siswa_id' => Auth::guard('siswa')->user()->id,
                    'jawaban' => $request['soal' . $i][0],
                    'hasil' => $hasil,
                    'tahun_ajaran' => $request->tahun_ajaran,
                    'kelas_id' => $request->kelas_id,
                    'mata_pelajaran_id' => $request->mata_pelajaran_id,
                    'category_soal_id' => $request->category_soal_id,
                    'semester_id' => $request->semester_id,
                    'tanggal' => $request->tanggal,
                ];

               $hasil_soal = Hasil_soal::create($create);
            }

            if ($request['soal' . $i][0] !== $request['soal' . $i][2]) {
                $hasil = 0;
                $create = [
                    'soal_id' => $request['soal' . $i][1],
                    'siswa_id' => Auth::guard('siswa')->user()->id,
                    'jawaban' => $request['soal' . $i][0],
                    'hasil' => $hasil,
                    'tahun_ajaran' => $request->tahun_ajaran,
                    'kelas_id' => $request->kelas_id,
                    'mata_pelajaran_id' => $request->mata_pelajaran_id,
                    'category_soal_id' => $request->category_soal_id,
                    'semester_id' => $request->semester_id,
                    'tanggal' => $request->tanggal,
                ];

                $hasil_soal = Hasil_soal::create($create);
             }


            $count = $hasil_soal->where('semester_id', $request->semester_id)->where('category_soal_id', $request->category_soal_id)->where('kelas_id', $request->kelas_id)->where('mata_pelajaran_id', $request->mata_pelajaran_id)->where('siswa_id', Auth::guard('siswa')->user()->id)->where('hasil', 1)->count('hasil');
        }
        if ($jumlahSoal == 20) {
            $ceknilai = $count * 5;


            $nilai = [
                'siswa_id' => Auth::guard('siswa')->user()->id,
                'nilai' => $ceknilai,
                'tahun_ajaran' => $request->tahun_ajaran,
                'kelas_id' => $request->kelas_id,
                'mata_pelajaran_id' => $request->mata_pelajaran_id,
                'category_soal_id' => $request->category_soal_id,
                'master_category_soal_id' => $request->master_category_soal_id,
                'semester_id' => $request->semester_id,
                'tanggal' => $request->tanggal,
                'total_soal' => $jumlahSoal,
            ];
        }

        if ($jumlahSoal == 40) {
            $ceknilai = $count * 2.5;


            $nilai = [
                'siswa_id' => Auth::guard('siswa')->user()->id,
                'nilai' => $ceknilai,
                'tahun_ajaran' => $request->tahun_ajaran,
                'kelas_id' => $request->kelas_id,
                'mata_pelajaran_id' => $request->mata_pelajaran_id,
                'category_soal_id' => $request->category_soal_id,
                'master_category_soal_id' => $request->master_category_soal_id,
                'semester_id' => $request->semester_id,
                'tanggal' => $request->tanggal,
                'total_soal' => $jumlahSoal,
            ];
        }

        if ($jumlahSoal == 10
        ) {
            $ceknilai = $count * 10;
            $nilai = [
                'siswa_id' => Auth::guard('siswa')->user()->id,
                'nilai' => $ceknilai,
                'tahun_ajaran' => $request->tahun_ajaran,
                'kelas_id' => $request->kelas_id,
                'mata_pelajaran_id' => $request->mata_pelajaran_id,
                'category_soal_id' => $request->category_soal_id,
                'master_category_soal_id' => $request->master_category_soal_id,
                'semester_id' => $request->semester_id,
                'tanggal' => $request->tanggal,
                'total_soal' => $jumlahSoal,
            ];
        }

        hasil_nilai::create($nilai);   
        // return back();
        return back()->with('success', 'berhasil mengerjakan soal');
        // foreach ($request->input('soal' . [$i]) as $key => $soal) {

        //     if ($request->jawaban == $soal) {
        //         $hasil = 1;
        //         $create = [
        //             'soal_id' => $request->soal_id,
        //             'siswa_id' => Auth::guard('siswa')->user()->id,
        //             'jawaban' => $request->jawaban,
        //             'hasil' => $hasil,
        //         ];

        //         Hasil_soal::create($create);
        //         // return back()->with('success', 'kissss');
        //     }

        //     if ($request->jawaban !== $soal) {
        //         $hasil = 0;
        //         $create = [
        //             'soal_id' => $request->soal_id,
        //             'siswa_id' => Auth::guard('siswa')->user()->id,
        //             'jawaban' => $request->jawaban,
        //             'hasil' => $hasil,
        //         ];

        //         Hasil_soal::create($create);
        //         // return back()->with('success', 'kissss');
        //     }

        //     $i++;
        // }
        // }
    }

    // public function lihat_nilai(Request $request,$semester, $category_soal, $mata_pelajaran_id)
    // {

    //     $cek = Hasil_soal::where('semester_id', $request->semester_id)->where('category_soal_id', $request->category_soal_id)->where('kelas_id', $request->kelas_id)->where('mata_pelajaran_id', $request->mata_pelajaran_id)->where('siswa_id', Auth::guard('siswa')->user()->id)->count('id');

    //     return view('frontend.siswa.soal.hasil_soal' , compact('soal', 'semestersemester', 'category_soal', 'mata_pelajaran', 'hasil_soal', 'hasil_soal_benar', 'hasil_soal_salah'));
    // }

    public function lihat_nilai_store(Request $request, $semester, $category_soal, $mata_pelajaran_id)
    {

        // $semestersemester = Semester::where('id', decrypt($semester))->firstOrFail();
        // $category_soal = Category_soal::where('id', decrypt($category_soal))->firstOrFail();
        // $mata_pelajaran = MataPelajaran::where('id', decrypt($mata_pelajaran_id))->firstOrFail();

        // $soal = Soal::where('semester_id', $semestersemester->id)->where('category_soal_id', $category_soal->id)->where('kelas_id', $category_soal->kelas_id)->where('mata_pelajaran_id', $mata_pelajaran->id)->count('category_soal_id');
        // $hasil_soal = Hasil_soal::where('semester_id', $semestersemester->semester_id)->where('category_soal_id', $category_soal->category_soal_id)->where('kelas_id', $category_soal->kelas_id)->where('mata_pelajaran_id', $mata_pelajaran->mata_pelajaran_id)->where('siswa_id', Auth::guard('siswa')->user()->id)->sum('hasil');
        // $hasil_soal_benar = Hasil_soal::where('semester_id', $semestersemester->semester_id)->where('category_soal_id', $category_soal->category_soal_id)->where('kelas_id', $category_soal->kelas_id)->where('mata_pelajaran_id', $mata_pelajaran->mata_pelajaran_id)->where('siswa_id', Auth::guard('siswa')->user()->id)->where('hasil', 1)->count('hasil');
        // $hasil_soal_salah = Hasil_soal::where('semester_id', $semestersemester->semester_id)->where('category_soal_id', $category_soal->category_soal_id)->where('kelas_id', $category_soal->kelas_id)->where('mata_pelajaran_id', $mata_pelajaran->mata_pelajaran_id)->where('siswa_id', Auth::guard('siswa')->user()->id)->where('hasil', 0)->count('hasil');


        // $cek_siswa = hasil_nilai::where('semester_id', $semestersemester->semester_id)->where('category_soal_id', $request->category_soal_id)->where('kelas_id', $request->kelas_id)->where('mata_pelajaran_id', $request->mata_pelajaran_id)->where('siswa_id', Auth::guard('siswa')->user()->id)->count('nilai');

        // $create = [
        //     'siswa_id' => Auth::guard('siswa')->user()->id,
        //     'nilai' => $request->nilai,
        //     'tahun_ajaran' => $request->tahun_ajaran,
        //     'kelas_id' => $request->kelas_id,
        //     'mata_pelajaran_id' => $request->mata_pelajaran_id,
        //     'category_soal_id' => $request->category_soal_id,
        //     'semester_id' => $request->semester_id,
        //     'tanggal' => $request->tanggal,
        // ];

        // hasil_nilai::create($create);

        // return view('frontend.siswa.soal.hasil_soal', compact('soal', 'semestersemester', 'category_soal', 'mata_pelajaran', 'hasil_soal', 'hasil_soal_benar', 'hasil_soal_salah', 'cek_siswa')); 
    }
    
}
