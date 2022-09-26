@extends('layouts.template_guru')
@section('contents')
{{-- {{\Carbon\Carbon::now('Asia/Jakarta')->format('Y')}} --}}
{{-- @foreach($nilai as $p)
    {{$}}
@endforeach --}}
                      <div class="row">
                        <div class="col-12">
                            <div class="card mt-2">
                                <div class="card-body">
                                    <a href="{{route('prosesRaport')}}">Proses Raport</a>
                                    <form action="" method="get" class="site-block-top-search" >
                                        @csrf
                                        
                                        {{-- <input type="hidden" value="{{ $jadwal->id }}" name='jadwal_id'>  --}}
                                        <div class="row">
                                            <div class="col-3">
                                                <label>pilih tahun</label>
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
                                                {{-- <select class="form-control" name="semester" id="semester">
                                                     @foreach($semester as $p)
                                                        <option value="{{ $p->id }}">{{ $p->name }}</option>
                                                    @endforeach
                                                </select> --}}
                                            </div>
                                        </div>
                                        <input type="submit" class="btn btn-primary mt-2 mb-2" value="cari">
                                    </form>
                                    {{-- <a href="{{ route('kelas-masuk' ,encrypt($jadwal->id))}}" class="btn btn-primary"> kembali</a> --}}
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Siswa</th>
                                                    <th>nisn</th>
                                                    <th>nilai tugas</th>
                                                    <th>nilai ulangan</th>
                                                    <th>nilai ujian</th>
                                                    <th>nilai raport</th>
                                                    <th>kelas</th>
                                                    <th>semester</th>
                                                    <th>tahun ajaran</th>
                                                    <th>action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <h1>nilai raport</h1>
                                                    @foreach ($raport as $p)
                                                        <tr>
                                                            <td>{{$p->siswa->name}}</td>
                                                            <td>{{$p->siswa->nisn}}</td>
                                                            <td>{{$p->nilai_tugas}}</td>
                                                            <td>{{$p->nilai_ulangan}}</td>
                                                            <td>{{$p->nilai_ujian}}</td>
                                                            <td>{{$p->nilai_raport }}</td>
                                                            <td>{{$p->kelas->kelas}}</td>
                                                            <td>{{$p->semestersemester->name}}</td>
                                                            <td>{{$p->tahun_ajaran}}</td>
                                                            <td><a href="/raport/buat/{{$p->id}}/{{$p->siswa->id}}" class="btn btn-success">submit</a></td>
                                                        </tr>
                                                    @endforeach
                                            </tbody>
                                        </table>
                                    </div>

                                       <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Siswa</th>
                                                    <th>category nilai</th>
                                                    <th>nilai rata rata</th>
                                                    <th>semester</th>
                                                    <th>tahun ajaran</th>
                                                    {{-- <th>action</th> --}}
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <h1>nilai rata rata</h1>
                                                    @foreach ($nilai as $p)
                                                    {{-- @php
                                                        $hitung = $p->$nilaisum ;
                                                    @endphp --}}
                                                        <tr>
                                                            <td>{{$p->siswa_name}}</td>
                                                            <td>{{$p->category_name}}</td>
                                                            <td>
                                                                @if($p->category_id)
                                                                    @if($p->category_id == 1)
                                                                        {{$p->nilaisum / $p->master_category_soal * 0.2}}
                                                                    @endif
                                                                    @if($p->category_id == 2)
                                                                        {{$p->nilaisum / $p->master_category_soal * 0.6}}
                                                                    @endif
                                                                    @if($p->category_id == 3)
                                                                        {{$p->nilaisum / $p->master_category_soal * 0.2}}
                                                                    @endif
                                                                @endif
                                                            </td>
                                                            <td>{{$p->semester}}</td>
                                                            <td>{{$p->tahun_ajaran}}</td>
                                                            {{-- <td><a href="{{ route('raport_masuk', $p->id) }}" class="btn btn-success">submit</a></td> --}}
                                                        </tr>
                                                    @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    {{-- @foreach ($raport as $raport)
                        @foreach($nilai as $nilai2)
                            @if($raport->siswa->name == $nilai2->siswa_name)
                                {{$raport->siswa->name}}
                            @endif
                        @endforeach
                    @endforeach --}}
@endsection