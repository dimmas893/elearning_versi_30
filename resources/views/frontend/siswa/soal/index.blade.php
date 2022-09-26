@extends('layouts.template_siswa')
@section('contents')
<x-alert/>
<div>
        <div class="row">
            <div class="col-12">
                <div class="card mt-2">
                    {{-- <h2>selamat mengerjakan</h2> --}}
                    <div class="card-body">
                             @if($cek > 0)
                                    <div class="card">
                                        <div class="row">
                                            <div class="col">
                                                <div class="card-header">
                                                    {{$hasil_soal->soal_id}}
                                                    {{-- @foreach($hasil_soal as $p) --}}
                                                        <p class="text-center"><h3 class="text-center">{{ $category_soal->name }}</h3></p>
                                                        <p class="text-center">
                                                            <h4 class="text-center" style="color: rgb(3, 235, 53)">
                                                               {{ $hasil_soal->nilai}}
                                                            </h4>
                                                        </p>
                                                    </div>
                                                {{-- @endforeach --}}
                                                <div class="card-body">
                                                    <p class="text-center">total soal = {{ $hasil_soal->total_soal }} soal</p>
                                                    <p class="text-center">jawaban benar =  {{ $hasil_soal_benar }} soal</p>
                                                    <p class="text-center">jawaban salah = {{ $hasil_soal_salah }} soal</p>
                                                    
                                                    <div class="text-center">
                                                        
                                                        <td> <a href="/categories/all2/{{encrypt($jadwal->id)}}" class="btn btn-success">kembali</a></td>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> 
                                    {{-- <form action="/soal/lihat/nilai/{{encrypt($semestersemester->id)}}/{{encrypt($category_soal->id)}}/{{encrypt($mata_pelajaran->id)}}" method="post">
                                        @csrf
                                        <input type="hidden" value="{{ $category_soal->id }}" name="category_soal_id">
                                        <input type="hidden" value="{{ $category_soal->kelas->id }}" name="kelas_id">
                                        <input type="hidden" value="{{ $mata_pelajaran->id }}" name="mata_pelajaran_id">
                                        <input type="hidden" value="{{ \Carbon\Carbon::now('Asia/Jakarta')->format('Y') }}" name="tahun_ajaran">
                                        <input type="hidden" value="{{ $semestersemester->id }}" name="semester_id">
                                        <input type="hidden" value="{{$hasil_soal}} " name="nilai">
                                        <input type="submit" class="btn btn-success" value="lihat nilai">
                                    </form> --}}
                                @else
                                        <div class="table-responsive mt-4">    

                                        <div class="card">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="card-body">
                                                        <div>
                                                            
                                                            <?php $i = 1; ?>
                                                            <?php $cocote = 0; ?>                       
                                                           <form action="{{ route('siswa_soal_store') }}" method="post">
                                                                @csrf
                                                                <input type="hidden" name="jumlah_soal" value="{{$soal->count()}}">
                                                                {{-- <h1>total soal {{ soa }}</h1> --}}
                                                                @foreach($soal as $p)
                                                                <input type="hidden" value="{{ $p->jawaban }}" name="soal{{ $cocote }}[]"/>
                                                                <input type="hidden" value="{{ $p->soal_idid }}" name="soal{{ $cocote }}[]"/>
                                                                <input type="hidden" value="{{ $category_soal->id }}" name="category_soal_id">
                                                                <input type="hidden" value="{{ $category_soal->kelas->id }}" name="kelas_id">
                                                                <input type="hidden" value="{{ $mata_pelajaran->id }}" name="mata_pelajaran_id">
                                                                <input type="hidden" value="{{ \Carbon\Carbon::now('Asia/Jakarta')->format('Y') }}" name="tahun_ajaran">
                                                                <input type="hidden" value="{{ $semestersemester->id }}" name="semester_id">
                                                                <input type="hidden" value="{{ $category_soal->master_category_soal_id }}" name="master_category_soal_id">
                                                                <input type="hidden" value="{{\Carbon\Carbon::now()->isoFormat('D MMM Y')}}" name="tanggal">
                                                                {{-- {{ $p->total }} --}}
                                                                    <div>
                                                                        <div class="form-group">
                                                                                    {{ $loop->iteration }}. {{ $p->soal }}
                                                                        <div class="question">
                                                                            <br>
                                                                            <label class="radio-inline" required>
                                                                            <input type="radio" name="soal{{ $cocote }}[]" class="optradio" value="{{ $p->opsi_a }}"> {{ $p->opsi_a }}
                                                                            </label>
                                                                            <br>
                                                                            <label class="radio-inline">
                                                                            <input type="radio" name="soal{{ $cocote }}[]" class="optradio" value="{{ $p->opsi_b }}"> {{ $p->opsi_b }}
                                                                            </label>
                                                                            <br>
                                                                            <label class="radio-inline">
                                                                            <input type="radio" name="soal{{ $cocote }}[]" class="optradio" value="{{ $p->opsi_c }}"> {{ $p->opsi_c }}
                                                                            </label>
                                                                            <br>
                                                                            <label class="radio-inline">
                                                                            <input type="radio" name="soal{{ $cocote }}[]" class="optradio" value="{{ $p->opsi_d }}"> {{ $p->opsi_d }}
                                                                            </label>
                                                                        </div>
                                                                       
                                                                    </div>
                                                                    <?php $cocote++; ?>
                                                                @endforeach
                                                                <input type="submit" class="btn btn-primary" value="submit"> 
                                                            </form>
                                                            {{-- {{ $soal }} --}}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
        <?php $i++; ?>
                            @endif
                    </div>
                </div>
            </div>
        </div>
        </div>
        </div>
        </div>
        </div>
        </div>
        </div>
        </div>

    </div>
</div>
        @endsection