 @extends('layouts.template_guru')
 @section('contents')
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
                                                    {{-- <th>action</th> --}}
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <h1>nilai raport</h1>
                                                    {{-- @foreach ($raport as $p) --}}
                                                        <tr>
                                                         
                                                            <td>{{$raport->siswa->name}}</td>
                                                            <td>{{$raport->siswa->nisn}}</td>
                                                            <td>{{$raport->nilai_tugas}}</td>
                                                            <td>{{$raport->nilai_ulangan}}</td>
                                                            <td>{{$raport->nilai_ujian}}</td>
                                                            <td>{{$raport->nilai_raport }}</td>
                                                            <td>{{$raport->kelas->kelas}}</td>
                                                            <td>{{$raport->semestersemester->name}}</td>
                                                            <td>{{$raport->tahun_ajaran}}</td>
                                                            {{-- <td><a href="/raport/buat/{{$p->id}}/{{$p->siswa->id}}" class="btn btn-success">submit</a></td> --}}
                                                        </tr>
                                                    {{-- @endforeach --}}
                                            </tbody>
                                        </table>
                                    </div>
                                    {{-- {{$hasil_nilai}} --}}

                                 <div class="row">
                                    <div class="col-6">
                                        <div class="card">
                                            <div class="card-header text-center">
                                                <h3>daftar nilai</h3>
                                            </div>
                                            <div class="card-body text-center">
                                <div class="table-responsive">
                                    <form action="{{route('wali_kelas_raport_cari_id_post', $raport->id)}}" method="post">
                                         @csrf
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Siswa</th>
                                                    <th>category soal</th>
                                                    <th>nilai</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <h1>nilai rata rata</h1>
                                                {{-- {{$hasil_nilai}} --}}
                                                {{-- {{$raport}} --}}
                                                    @foreach ($hasil_nilai as $p)
                                                        <tr>
                                                               <td>{{$raport->siswa->name}}</td>
                                                            {{-- <td>{{$p->siswa_name}}</td> --}}
                                                            <td>{{$p->category_name}}</td>
                                                            <td> 
                                                                @if($p->category_id)
                                                                    @if($p->category_id == 1)
                                                                        {{$ulangan = $p->nilaisum / $p->master_category_soal * 0.2}}
                                                                        <input type="hidden" name="nilai_ulangan" value="{{$ulangan}}">
                                                                    @endif
                                                                    @if($p->category_id == 2)
                                                                        {{$ujian = $p->nilaisum / $p->master_category_soal * 0.6}}
                                                                        <input type="hidden" name="nilai_ujian" value="{{$ujian}}">
                                                                    @endif
                                                                    @if($p->category_id == 3)
                                                                        {{$tugas = $p->nilaisum / $p->master_category_soal * 0.2}}
                                                                        <input type="hidden" name="nilai_tugas" value="{{$tugas}}">
                                                                    @endif
                                                                @endif
                                                            </td>
                                                            <td>
                                                                
                                                            </td>
                                                            {{-- <td>{{$p->nilaisum}}</td> --}}
                                                            {{-- <td><a href="/raport/buat/{{$p->id}}/{{$p->siswa->id}}" class="btn btn-success">submit</a></td> --}}
                                                        </tr>
                                                        @endforeach
                                                        <input type="submit" class="btn btn-primary mb-3" value="masukan nilai">
                                                    </tbody>
                                                </table>
                                            </form>
                                        </div>
                                            </div>
                                        </div>
                                    </div>
                                 </div>

                                    
@endsection