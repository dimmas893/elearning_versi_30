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
                                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#create">
                                                    create
                                                </button>
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
                                                @foreach($category_soal as $p)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $p->name }}</td>
                                                        <td>{{ $p->kelas->kelas }}</td>
                                                        <td>{{ $p->semester->name }}</td>
                                                        <td>
                                                            {{-- <a href="{{ route('categories.edit', $p->id) }}" class="btn btn-primary">edit</a> --}}
                                                            {{-- <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete">
                                                                delete
                                                            </button>
                                                            <div class="modal fade" id="delete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Apakah anda ingin menghapusnya ?</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div> --}}
                                                                {{-- <div class="modal-body"> --}}
                                                                    {{-- <form action="{{ route('categories.destroy', $p->id) }}" method="DELETE">
                                                                        @csrf
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> 
                                                                        <input type="submit" class="btn btn-danger" value="deletes">
                                                                    </form> --}}
                                                                {{-- </div>
                                                                </div>
                                                            </div>
                                                            </div> --}}
                                                            
                                                            <a href="/mata_pelajaran/pilih/{{encrypt($p->id)}}/{{encrypt($jadwal->id)}}" class="btn btn-success">pilih mapel</a>
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
{{-- {{ $category_soal_master }} --}}
<div class="modal fade" id="create" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Category Soal</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{ route('categories.store') }}" method="post">
            @csrf
            <input type="hidden" value="{{ $jadwal->kelas_id }}" name='kelas_id'>
            <input type="hidden" value="{{ $category_soal_master->id }}" name='master_category_soal_id'>
            <div class="mt-3">
                <label for="category soal">category soal</label>
                <input type="text" class="form-control" placeholder="masukan category soal" name="name">
            </div>
            <div class="mt-3">
                    <select class="form-control" name="semester_id" id="semester_id">
                        @foreach($semester as $p)
                            <option value="{{ $p->id }}">{{ $p->name }}</option>
                        @endforeach
                    </select>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>

</div>
@endsection