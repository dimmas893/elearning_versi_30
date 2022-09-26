@extends('layouts.template_siswa')
@section('contents')

{{-- @if() --}}
    <div class="card">
        <div class="row">
            <div class="col">
                <div class="card-header">
                    <p class="text-center"><h3 class="text-center">{{ $category_soal->name }}</h3></p>
                    <p class="text-center">
                        <h4 class="text-center" style="color: rgb(3, 235, 53)">
                            @if($soal == 40)
                                    nilai anda = {{ $hasil_soal * 2.5 }}
                                @endif


                                @if($soal == 20)
                                    nilai anda = {{ $hasil_soal * 5 }}
                                @endif


                                @if($soal == 10)
                                        nilai anda = {{ $hasil_soal * 10 }}
                            @endif
                        </h4>
                    </p>
                </div>
                <div class="card-body">
                    <p class="text-center">total soal = {{ $soal }} soal</p>
                    <p class="text-center">jawaban benar = {{ $hasil_soal_benar }} soal</p>
                    <p class="text-center">jawaban salah = {{ $hasil_soal_salah }} soal</p>
                    
                    <div class="text-center">
                        <td><a href="/soal/siswa/{{encrypt($semestersemester->id)}}/{{encrypt($category_soal->id)}}/{{encrypt($mata_pelajaran->id)}}" class="btn btn-success">kembali</a></td>
                    </div>
                </div>
            </div>
        </div>
    </div>
{{-- @endif --}}

@endsection