@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">  Add Category </div>
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
                        <form action="{{route('category.store')}}" method="post">
                            @csrf
                            <div class="form-group row">
                                <label for="" class="col-sm-2 col-form-label">Name Category</label>
                                <div class="col-sm-10">
                                    <input id="name" name="name_category" type="text" class="form-control" placeholder="Masukkan Nama Kategori">
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
