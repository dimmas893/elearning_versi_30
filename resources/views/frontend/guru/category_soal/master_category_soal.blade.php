@extends('layouts.template_guru')
@section('contents')
<div>
<x-alert />
            <div class="card card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="card mt-2">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-6">
                                            <form action="{{ route('categories.filter') }}" method="get" class="site-block-top-search" >
                                                @csrf
                                                <div class="row mb-3">
                                                    <div class="col-6">
                                                           <input type="text" class="form-control" name="name" id="name" placeholder="masukan name">
                                                    </div>
                                                    <div class="col-6">
                                                        <input type="submit" class="btn btn-primary" value="cari">
                                                    </div>
                                                </div>
                                                {{-- <a href="{{ route('kelas-masuk' ,encrypt($jadwal->id))}}" class="btn btn-success">Kembali</a> --}}
                                            </form>
                                        </div>
                                        {{-- <div class="col-6">
                                            <div class="text-right">
                                                <!-- Button trigger modal -->
                                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#create">
                                                    create
                                                </button>
                                            </div>
                                        </div> --}}
                                    </div>
                                    <div class="table-responsive">    
                                        <table class="table table-hover">
                                            <thead>
                                                <td>No</td>
                                                <td>Nama Category</td>
                                                {{-- <td>Kelas</td> --}}
                                                <td>Action</td>
                                            </thead>
                                            <tbody>
                                                <h1>category soal</h1>
                                                @foreach($master_category_soal as $p)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $p->name }}</td>
                                                        {{-- <td>{{ $p->kelas->kelas }}</td> --}}
                                                        <td>
                                                            <a href="/mata_pelajaran/{{encrypt($p->id)}}/{{encrypt($jadwal->id)}}" class="btn btn-success">pilih</a>
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

</div>
@endsection