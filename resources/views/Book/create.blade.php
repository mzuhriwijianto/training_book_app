@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header"> Add Book </div>
                    <div class="card-body">
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        <form action="{{route('book.store')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <label for="judul" class="col-sm-2 col-form-label">Judul</label>
                                <div class="col-sm-10">
                                    <input id="judul" name="judul" type="text" class="form-control" placeholder="Masukkan Nama Judul">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="tahun" class="col-sm-2 col-form-label">Tahun</label>
                                <div class="col-sm-10">
                                    <input id="tahun" name="tahun" type="text" class="form-control" placeholder="Masukkan Tahun">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="cover" class="col-sm-2 col-form-label">Cover</label>
                                <div class="col-sm-10">
                                    <input id="cover" name="cover" type="file" class="form-control" placeholder="Upload Cover Buku">
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-dark mb-2" value="submit">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
