<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use App\Models\Hari;
use App\Models\Jadwal;
use App\Models\Kelas;
use App\Models\MataPelajaran;
use App\Models\Ruangan;
use App\Models\Siswa;
use Illuminate\Http\Request;

class JadwaCOntroller extends Controller
{

    // set index page view
    public function index()
    {
        $guru = Guru::all();
        $matapelajaran = MataPelajaran::all();
        $hari = Hari::all();
        $kelas = Kelas::all();

        return view('admin.jadwal.index', compact([
            'matapelajaran',
            'hari',
            'guru',
            'kelas'
        ]));
    }

    public function index_api()
    {
        $jadwal = Jadwal::with('mata_pelajaran', 'hari', 'kelas', 'guru')->get();

        return response()->json([
            'data' => 200,
            'matapelajaran' => $jadwal
        ]);
    }

    // handle fetch all eamployees ajax request
    public function all()
    {
        $emps = Jadwal::with('mata_pelajaran', 'hari', 'kelas', 'guru')->get();
        $output = '';
        if ($emps->count() > 0) {
            $output .= '<table class="table table-striped table-sm text-center align-middle">
            <thead>
              <tr>
              <th>Id</th>
              <th>Nama Pengajar</th>
              <th>Mata Pelajaran</th>   
              <th>Kelas</th>   
              <th>hari</th>   
              <th>jam masuk</th>   
              <th>jam keluar</th>   
                <th>Action</th>
              </tr>
            </thead>
            <tbody>';
            foreach ($emps as $emp) {
                $output .= '<tr>
                <td>' . $emp->id . '</td>
                <td>' . $emp->guru->name . '</td>
                <td>' . $emp->mata_pelajaran->name . '</td>
                <td>' . $emp->kelas->kelas   . '</td>
                <td>' . $emp->hari->name   . '</td>
                <td>' . $emp->jam_masuk   . '</td>
                <td>' . $emp->jam_keluar   . '</td>
                <td>
                  <a href="#" id="' . $emp->id . '" class="text-success mx-1 editIcon" data-bs-toggle="modal" data-bs-target="#editjadwalmodal"><i class="bi-pencil-square h4"></i></a>

                  <a href="#" id="' . $emp->id . '" class="text-danger mx-1 deleteIcon"><i class="bi-trash h4"></i></a>
                </td>
              </tr>';
            }
            $output .= '</tbody></table>';
            echo $output;
        } else {
            echo '<h1 class="text-center text-secondary my-5">No record present in the database!</h1>';
        }
    }

    // handle insert a new Ruangan ajax request
    public function store(Request $request)
    {
        $empData = [
            'mata_pelajaran_id' => $request->mata_pelajaran_id,
            'guru_id' => $request->guru_id,
            // 'ruangan_id' => $request->ruangan_id,
            'hari_id' => $request->hari_id,
            'jam_masuk' => $request->jam_masuk,
            'jam_keluar' => $request->jam_keluar,
            'kelas_id' => $request->kelas_id,
        ];
        Jadwal::create($empData);
        return response()->json([
            'status' => 200,
        ]);
    }

    // handle edit an Ruangan ajax request
    public function edit(Request $request)
    {
        $id = $request->id;
        $emp = Jadwal::find($id);
        return response()->json($emp);
    }

    // handle update an Ruangan ajax request
    public function update(Request $request)
    {
        $emp = Jadwal::find($request->emp_id);
        $empData = [
            'mata_pelajaran_id' => $request->mata_pelajaran_id,
            'guru_id' => $request->guru_id,
            // 'ruangan_id' => $request->ruangan_id,
            'hari_id' => $request->hari_id,
            'jam_masuk' => $request->jam_masuk,
            'jam_keluar' => $request->jam_keluar,
            'kelas_id' => $request->kelas_id,
        ];
        if ($empData) {
            $emp->update($empData);
            return response()->json([
                'status' => 200,
            ], 200);
        }
        return response()->json([
            'status' => 'gagal',
        ]);
    }

    // handle delete an Ruangan ajax request
    public function delete(Request $request)
    {
        $id = $request->id;
        $emp = Jadwal::find($id);
        Jadwal::destroy($id);
    }
}
