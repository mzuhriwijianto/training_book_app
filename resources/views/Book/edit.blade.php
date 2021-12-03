@extends('layouts.app')

@section('css_custom')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@1.3.4/dist/select2-bootstrap4.min.css">
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header"> Edit Book </div>
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
                            <div class="form-group row mb-2">
                                <label for="judul" class="col-sm-2 col-form-label">Judul</label>
                                <div class="col-sm-10">
                                    <input id="judul" name="judul" type="text" class="form-control" placeholder="Masukkan Nama Judul" value="{{ old('judul') }}">
                                </div>
                            </div>
                            <div class="form-group row mb-2">
                                <label for="tahun" class="col-sm-2 col-form-label">Tahun</label>
                                <div class="col-sm-10">
                                    <input id="tahun" name="tahun" type="text" class="form-control" placeholder="Masukkan Tahun" value="{{ old('tahun') }}">
                                </div>
                            </div>
                            {{-- coding belum selesai --}}
                            <div class="form-group row mb-2">
                                <label for="cover" class="col-sm-2 col-form-label">Cover</label>
                                <div class="col-sm-10">
                                    <small class="text-muted">Current Cover</small>
                                    @if ($book->cover)
                                    <img src="{{asset('storage/'. $book->cover)}}" width="100px"></small><br>
                                    @endif
                                    <input id="cover" name="cover" type="file" class="form-control">
                                    <small class="text-muted">*Kosongkan jika tidak ingin mengubah cover</small>
                                </div>
                            </div>
                            {{-- coding belum selesai --}}
                            <div class="form-group row mb-2">
                                <label for="cover" class="col-sm-2 col-form-label">Category</label>
                                <div class="col-sm-10">
                                    <select id="category" name="category[]" type="file" multiple class="form-control">
                                    @forelse ($book->categories as $category)
                                        <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                                    @empty
                                        <option></option>
                                    @endforelse
                                    </select>
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

@section('js_custom')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script>
    $(function(){
        $('#category').select2({
            placeholder: 'Pilih kategori',
            ajax: {
                url: '{{ route('category.all') }}',
                processResults: function(data){
                    return {
                        results: data.map(function(item){
                            return {
                                id: item.id,
                                text: item.name
                            }
                        })
                    }
                }
            }
        })
    })
</script>
@endsection
