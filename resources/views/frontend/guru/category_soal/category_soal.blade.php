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
                                        <div class="col-6">
                                            <div class="text-right">
                                                <!-- Button trigger modal -->
                                                {{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#create">
                                                    create
                                                </button> --}}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="table-responsive">    
                                        <table class="table table-hover">
                                            <thead>
                                                <td>No</td>
                                                <td>Nama Category</td>
                                                <td>Kelas</td>
                                                <td>semester</td>
                                                <td>Action</td>
                                            </thead>
                                            <tbody>
                                                <h1>data soal</h1>
                                                @foreach($mata_pelajaran as $p)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $p->name }}</td>
                                                        <td>{{ $category_soalcategory_soal->kelas->kelas }}</td>
                                                        <td>{{ $category_soalcategory_soal->semester->name }}</td>
                                                        <td>
                                                            <a href="/soal/semester/{{encrypt($p->id)}}/{{encrypt($category_soalcategory_soal->id)}}" class="btn btn-success">pilih mapel</a>
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