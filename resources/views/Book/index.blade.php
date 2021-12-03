@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <caption>List of Book</caption>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-4 col-md-3 col-lg-2">
                            <a href="{{route('book.create')}}" class="btn btn-dark btn-block-mb-2">Add Book</a>
                        </div>
                    </div>
                    @if (session('status'))
                        <div class="alert alert-success mt-2">
                            {{session('status')}}
                        </div>
                    @endif
                    <table class="table table-striped mt-2">
                        <thead class="table-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Cover</th>
                            <th scope="col">Tahun</th>
                            <th scope="col">Category</th>
                            <th scope="col">Created At</th>
                            <th scope="col">Updated At</th>
                            <th scope="col" class="text-center">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @forelse ($books as $key => $book)
                            <tr>
                                <th scope="row">{{ $books->firstItem() + $key}}</th>
                                <td>{{$book->judul}}</td>
                                <td>
                                    @if ($book->cover)
                                        <img src="{{ asset('storage/'.$book->cover) }}" alt="Book Cover" width="100px">
                                    @else
                                        <span class="badge bg-danger">Cover belum diupload</span>
                                    @endif
                                </td>
                                <td>{{$book->tahun}}</td>
                                <td>
                                    @forelse ($book->categories as $category)

                                    <li>{{ $category->name }}</li>

                                    @empty

                                    <li>Buku tidak memiliki kategori</li>

                                    @endforelse
                                </td>
                                <td>{{$book->created_at}}</td>
                                <td>{{$book->updated_at}}</td>
                                <td class="text-center">
                                    <a href="{{route('book.edit', ['book'=>$book->id])}}" class="btn btn-primary"><b>Edit</b></a>
                                    @component('components.delete')
                                        @slot('url')
                                            {{ route('book.destroy', ['book'=>$book->id]) }}
                                        @endslot
                                        @slot('value')
                                            Hapus
                                        @endslot
                                    @endcomponent
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5">Data empty</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="float-right">
                        {{ $books->onEachSide(1)->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
