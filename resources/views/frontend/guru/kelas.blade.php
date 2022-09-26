@extends('layouts.template_guru')
@section('contents')
<x-alert />
@if($cek == 0)
   <div class="col mb-2 mb-lg-0 text-center">
        <i data-feather="file" style="width: 80px; height: 60px; color: #6c757d"></i>
        <div class="mt-2 font-weight-bold" style="color: #6c757d;">Absensi</div>
        {{-- <h6 class="badge badge-dark">!</h6><br> --}}
        {{-- <h6 class="badge badge-dark">{{ $hadir_count }}</h6><br> --}}
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#absenhariini">
            Buat 
        </button>
    </div>

   <div class="modal fade" id="absenhariini" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">absensi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form action="{{ route('buat_absen') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                            <input type="hidden" value="{{ $jadwal->id }}" name='jadwal_id'> 
                            <input type="hidden" value="{{ $jadwal->kelas_id }}" name='kelas_id'> 
                            <input type="hidden" value="{{ $hariini }}" name='tanggal'>    
                            <input type="hidden" value="{{ $cekcok->semester }}" name='semester'>    
                            <input type="hidden" value="{{ \Carbon\Carbon::now('Asia/Jakarta')->format('Y') }}" name="tahun_ajaran">
                            {{-- <input type="hidden" value="{{\Carbon\Carbon::now()->isoFormat('D MMM Y')}}" name="tanggal"> --}}
                            {{-- <input type="hidden" value="{{  Auth::guard('guru')->user()->id }}" name='guru_id'>  --}}
                            {{-- <div class="my-2">
                                    <label for="">pertemuan</label>
                                    <input type="number" name="pertemuan" id="pertemuan" class="form-control" placeholder="masukan pertemuan">
                                </div> --}}
                                <div class="my-2">
                                    <label for="">pertemuan ke</label>
                                    <input type="text" class="form-control" value="{{$pertemuan + 1 }}" disabled>
                                </div>  
                                <div class="my-2">
                                    <label for="">Semester</label>
                                    <input type="text" class="form-control" value="{{ $cekcok->semes->name }}" disabled>
                                </div>  
                                <div class="my-2">
                                    <label for="">tahun ajaran</label>
                                    <input type="text" class="form-control" value="{{ \Carbon\Carbon::now('Asia/Jakarta')->format('Y') }}" disabled>
                                </div>  
                                    
                                {{-- <div class="my-2">
                                    <label for="">tahun ajaran</label>
                                    <select class="form-control" name="tahun_ajaran" id="tahun_ajaran">
                                        <option value="2020">2020</option>
                                        <option value="2021">2021</option>
                                        <option value="2022">2022</option>
                                    </select>
                                </div>   --}}
                        </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                    </div>
                </form>

            </div>
        </div>
@endif

@if($cek == 1)
<div>
    <div class="row justify-content-center">
        <div class="card col-sm-12 col-lg-5">
            <div class="card-body">
                
                    <div class="row">
                         {{-- <div class="col mb-3 mb-lg-0 text-center">
                            <i data-feather="book-open" style="width: 80px; height: 60px; color: #6c757d"></i>
                            <div class="mt-2 font-weight-bold" style="color: #6c757d;">Semua Materi</div>
                                <h6 class="badge badge-dark">{{ $semua_materi_tampil_count }}</h6><br>
                                <!-- Button trigger modal -->
                                <button class="btn btn-success" type="button" data-toggle="collapse" data-target="#tampilsemuamateri" aria-expanded="false" aria-controls="tampilsemuamateri">
                                        Lihat
                                </button>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#materi">
                                        Buat
                                    </button>
                        </div> --}}
                        <div class="col mb-2 mb-lg-0 text-center">
                            <i data-feather="file" style="width: 80px; height: 60px; color: #6c757d"></i>
                            <div class="mt-2 font-weight-bold" style="color: #6c757d;">Soal</div>
                            {{-- <h6 class="badge badge-dark">!</h6><br> --}}
                            {{-- <h6 class="badge badge-dark"></h6><br> --}}
                            <a type="button" class="btn btn-primary" href="{{ route('categories.master', encrypt($jadwal->id)) }}">
                                Buat
                            </a>
                            {{-- <button class="btn btn-success" type="button" data-toggle="collapse" data-target="#absensi" aria-expanded="false" aria-controls="absensi">
                                Lihat
                            </button> --}}
                        </div>
                        <div class="col mb-2 mb-lg-0 text-center">
                            <i data-feather="file" style="width: 80px; height: 60px; color: #6c757d"></i>
                            <div class="mt-2 font-weight-bold" style="color: #6c757d;">Absensi</div>
                            {{-- <h6 class="badge badge-dark">!</h6><br> --}}
                            {{-- <h6 class="badge badge-dark">{{ $hadir_count }}</h6><br> --}}
                            {{-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#absenhariini">
                                Buat
                            </button> --}}
                            <button class="btn btn-success" type="button" data-toggle="collapse" data-target="#belumabsensi" aria-expanded="false" aria-controls="belumabsensi">
                                Lihat
                            </button>
                        </div>
                    </div>
                    {{-- <hr class="mt-2"> --}}

                    {{-- <div class="row"> --}}
                        
                         {{-- <div class="col mb-2 mb-lg-0 text-center">
                            <i data-feather="file" style="width: 80px; height: 60px; color: #6c757d"></i>
                            <div class="mt-2 font-weight-bold" style="color: #6c757d;">Materi Hari Ini</div>
                            <h6 class="badge badge-dark">{{ $materi_hari_ini }}</h6><br>
                            <button class="btn btn-warning" type="button" data-toggle="collapse" data-target="#materihariini" aria-expanded="false" aria-controls="materihariini">
                                Lihat
                            </button>
                        </div> --}}
                        
                        {{-- <div class="col mb-2 mb-lg-0 text-center">
                            <i data-feather="file" style="width: 80px; height: 60px; color: #6c757d"></i>
                            <div class="mt-2 font-weight-bold" style="color: #6c757d;">belum absensi</div>
                            <h6 class="badge badge-dark">{{ $total_hadir }}</h6><br>
                            <button class="btn btn-warning" type="button" data-toggle="collapse" data-target="#belumabsensi" aria-expanded="false" aria-controls="belumabsensi">
                                Lihat
                            </button>
                        </div> --}}
                    {{-- </div> --}}
            </div>
        </div>
        <div class="card col-sm-12 col-lg-6 mx-1">
            <div class="card-body">
                <div class="row">
                    <div class="col mb-4 mb-lg-0 text-center">
                        <i data-feather="users" style="width: 100px; height: 40px"></i>
                        <div class="mt-2 font-weight-bold mb-1">Total Siswa</div>
                        <h6 class="badge badge-dark">{{ $count }}</h6> Siswa
                    </div>
                    {{-- <div class="col mb-4 mb-lg-0 text-center">
                        <i data-feather="user-check" style="width: 100px; height: 40px"></i>
                        <div class="mt-2 font-weight-bold mb-1">Absensi Keseluruhan 
                            <br>
                                                    @if($absen_izin_total !== null)
                                                       <h6 class="badge badge-dark">{{ $absen_izin_total }}</h6> siswa izin
                                                    @endif <br>
                                                     @if($absen_sakit_total !== null)
                                                        <h6 class="badge badge-dark">{{ $absen_sakit_total }}</h6> siswa sakit
                                                    @endif<br>
                                                     @if($absen_alpha_total !== null)
                                                        <h6 class="badge badge-dark">{{ $absen_alpha_total }}</h6> siswa alpa
                                                    @endif

                                                
                        </div>
                    </div>
                    
                    <div class="col mb-4 mb-lg-0 text-center">
                        <i data-feather="user-check" style="width: 100px; height: 40px"></i>
                        <div class="mt-2 font-weight-bold mb-1">Absensi hari ini 
                            <br>
                                                    @if($counthariini_izin !== null)
                                                       <h6 class="badge badge-dark">{{ $counthariini_izin }}</h6> siswa izin
                                                    @endif <br>
                                                     @if($counthariini_sakit !== null)
                                                       <h6 class="badge badge-dark">{{ $counthariini_sakit }}</h6> siswa sakit
                                                    @endif<br>
                                                     @if($counthariini_alpa !== null)
                                                        <h6 class="badge badge-dark">{{ $counthariini_alpa }}</h6> siswa alpa
                                                    @endif

                                                
                        </div>
                    </div> --}}
                    <div class="col mb-4 mb-lg-0 text-center">
                        <i data-feather="user-x" style="width: 100px; height: 40px"></i>
                        <div class="mt-2 font-weight-bold mb-1">belum absensi</div>
                        <h6 class="badge badge-dark">{{ $total_hadir }}</h6> siswa
                    </div>

                    <div class="col mb-4 mb-lg-0 text-center">
                        <i data-feather="user-x" style="width: 100px; height: 40px"></i>
                        <div class="mt-2 font-weight-bold mb-1">siswa hadir</div>
                        <h6 class="badge badge-dark">{{ $hadir_count }}</h6> siswa
                    </div>
                    {{-- tugas_pertemuan --}}

                    <div class="col mb-4 mb-lg-0 text-center">
                        <i data-feather="user-x" style="width: 100px; height: 40px"></i>
                        <div class="mt-2 font-weight-bold mb-1">Tidak Masuk</div>
                        <h6 class="badge badge-danger">{{ $hitung_absen }}</h6> siswa
                    </div>

                    {{-- <div class="col mb-4 mb-lg-0 text-center">
                        <i data-feather="user-x" style="width: 100px; height: 40px"></i>
                        <div class="mt-2 font-weight-bold mb-1">total pertemuan</div>
                        <h6 class="badge badge-danger">{{ $tugas_pertemuan }}</h6> siswa
                    </div> --}}
                </div>
            </div>
        </div>
    </div>

      
    
    {{-- <div class="collapse mt-4" id="materihariini">
        <div class="card card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="card mt-2">
                                <div class="card-body">
                                    <form action="{{ route('cari_materi_filter', encrypt($jadwal->id)) }}" method="get" class="site-block-top-search" >
                                        @csrf
                                        
                                        <input type="hidden" value="{{ $jadwal->id }}" name='jadwal_id'> 
                                        <div class="row">
                                            <div class="col-3">
                                                <label>pilih tahun ajaran</label>
                                                <select class="form-control" name="tahun_ajaran" id="tahun_ajaran">
                                                    <option class="form-control" value="2020">2020</option>
                                                    <option class="form-control" value="2021">2021</option>
                                                    <option class="form-control" value="2022">2022</option>
                                                    <option class="form-control" value="2023">2023</option>
                                                    <option class="form-control" value="2024">2024</option>
                                                    <option class="form-control" value="2025">2025</option>
                                                </select>
                                            </div>
                                            <div class="col-3">
                                                <label>pilih semester</label>
                                                <select class="form-control" name="semester" id="semester">
                                                    @foreach($semester as $p)
                                                        <option value="{{ $p->id }}">{{ $p->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <input type="submit" class="btn btn-primary mt-2 mb-2" value="cari">
                                    </form>
                                    
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead>
                                                <td>judul</td>
                                                <td>type</td>
                                                <td>file or link</td>
                                                <td>description</td>
                                                <td>semester</td>
                                                <td>tahun ajaran</td>
                                                <td>pertemuan</td>
                                                <td>tanggal</td>
                                                <td>Action</td>
                                            </thead>
                                            <tbody>
                                                <h1>Materi hari ini</h1>
                                                @foreach($materi_hari_ini_tampil as $p)
                                                    <tr>
                                                        <td>{{ $p->judul }}</td>
                                                        <td>{{ $p->type }}</td>
                                                        <td>{{ $p->file_or_link}}</td>
                                                        <td>{{ $p->description }}</td>
                                                        <td>{{ $p->semesters }}</td>
                                                        <td>{{ $p->tahun_ajaran }}</td>
                                                        <td>{{ $p->pertemuan }}</td>
                                                        <td>{{ $p->tanggal }}</td>
                                                        <td><button class="btn btn-success">Link</button></td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
        </div>
    </div> --}}
<div>
</div>

<div class="collapse mt-4" id="belumabsensi">
    <div class="row mb-4 mt-4">
        <div class="col-12">
            <div class="card mt-2">
                <div class="card-body">
                    <div class="table-responsive">
                        
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Siswa</th>
                                    <th>Keterangan</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                    <h1>siswa belum absens</h1>
                                    @foreach($hadir as $p)
                                        <tr>
                                            <td>
                                                {{ $p->siswa->name }}
                                            </td>
                                            <td>
                                                @if($p->status == null)
                                                    <p style="color:red">belum absens</p>
                                                @endif
                                                @if($p->status !== null)
                                                   {{ $p->status }}
                                                @endif
                                                 {{-- {{ $p->status }} --}}
                                            </td>
                                            <td>
                                                <a href="{{ route('kelas.store_absen_get', $p->id) }}" class="btn btn-primary">
                                                    absen
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

            {{-- //absens --}}
<div>
    <div class="modal fade" id="absen" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Buat Absen</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
                <h1>Absensi</h1>
                <div class="my-2">
                    <label for="name">Siswa</label> 
                    <div class="my-2">
                        <label for="name">Siswa</label>
                        <select class="form-control" name="status">
                            <option class="form-control" disabled>-----pilih absen----</option>
                            <option class="form-control" value="hadir">Hadir</option>
                            <option class="form-control" value="izin">Izin</option>
                            <option  class="form-control" value="sakit">Sakit</option>
                            </select>
                    </div>
                </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                    </div>
                                </form>
        </div>
    </div>
</div>
</div>

</div>

@endif
@endsection