<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTestRequest;
use App\Models\Category_soal;
use App\Models\Guru;
use App\Models\Hasil;
use App\Models\hasil_pertanyaan;
use App\Models\Jadwal;
use App\Models\Kelas;
use App\Models\master_category_soal;
use App\Models\Option;
use App\Models\Semester;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Category_soalController extends Controller
{
    public function index($id, $master_category_soal)
    {
        $jadwal = Jadwal::where('id', decrypt($id))->first();
        $master_category_soal = master_category_soal::where('id', decrypt($master_category_soal))->first();
        $category_soal = Category_soal::with('kelas', 'semester')->get();
        $semester = Semester::all();
        // $jadwal = Jadwal::where('guru_id', Auth::guard('guru')->user()->id)->get();
        // $kelas = Kelas::where('id', $jadwal->kelas_id)->get();
        return view('frontend.guru.category_soal.index', compact('category_soal', 'jadwal', 'semester', 'master_category_soal'));
    }

    public function master($id)
    {
        $jadwal = Jadwal::where('id', decrypt($id))->first();
        // $category_soal = Category_soal::with('kelas')->get();
        $master_category_soal = master_category_soal::all();
        // $jadwal = Jadwal::where('guru_id', Auth::guard('guru')->user()->id)->get();
        // $kelas = Kelas::where('id', $jadwal->kelas_id)->get();
        return view('frontend.guru.category_soal.master_category_soal', compact('jadwal', 'master_category_soal'));
    }



    public function index2($id)
    {
        $jadwal = Jadwal::where('id', decrypt($id))->first();
        $category_soal = Category_soal::with('kelas')->get();
        // $jadwal = Jadwal::where('guru_id', Auth::guard('guru')->user()->id)->get();
        // $kelas = Kelas::where('id', $jadwal->kelas_id)->get();
        return view('frontend.siswa.soal.category_soal', compact('category_soal', 'jadwal'));
    }

    public function store(Request $request)
    {
        $create = [
            'name' => $request->name,
            'kelas_id' => $request->kelas_id,
            'master_category_soal_id' => $request->master_category_soal_id,
            'semester_id' => $request->semester_id,
            'tahun_ajaran' => \Carbon\Carbon::now('Asia/Jakarta')->format('Y')
        ];

        Category_soal::create($create);

        return back()->with('success', 'Menambah Data Category soal berhasil');
    }

    public function destroy($id)
    {

        $category = Category_soal::destroy($id);
        return back()->with('success', 'berhasil menghapus');
    }

    public function edit($id)
    {
        $category_soal = Category_soal::FindOrFail($id);
        return view('frontend.guru.category_soal.edit', compact('category_soal'));
    }

    public function update(Request $request, $id)
    {
        $category_soal_update = Category_soal::FindOrFail($id);
        $category_soal_update->name = $request->name;
        $category_soal_update->save();
        $category_soal = Category_soal::all();
        return view('frontend.guru.category_soal.index', compact('category_soal'));
    }

    public function filter(Request $request)
    {
        $category_soal = Category_soal::where('name', 'like', '%' . $request->cari . '%')->get();
        return view('frontend.guru.category_soal.filter', compact('category_soal'));
    }
}
