<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Cache::remember(implode('-', request()->all()), 900, function () {
            return Book::with('categories')->paginate(10);
        });

        return view('book.index', [
            'books' => $books
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('book.create', [
            'category' => Category::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $request->validate([
            'judul' => 'required|min:4',
            'tahun' => 'required|numeric',
            'cover' => 'mimes:png,jpg|max:10000',
        ]);

        $book = new book();
        $book->judul = $request->judul;
        $book->tahun = $request->tahun;
        if ($request->file('cover')) {
            $imagepath = $request->file('cover')->store('book_cover', 'public');
            $book->cover = $imagepath;
        }
        $book->save();

        $book->categories()->attach($request->category);

        return redirect()->route('book.index')->with('status', 'buku berhasil ditambahkan');

        //dari hasil kodinganku salah
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        return view('book.edit', [
            'book' => $book
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        $request->validate([
            'judul' => 'required|min:4',
            'tahun' => 'required|numeric',
            'cover' => 'mimes:png,jpg|max:10000',
        ]);

        $book = new book();
        $book->judul = $request->judul;
        $book->tahun = $request->tahun;
        if ($file) {
            if ($book->cover) {
                Storage::delete('public/' . $book->cover);
            }
            $imagePath = $file->storeAs('book_cover', $file->getClientOriginalName(), 'public');
            $book->cover = $imagePath;
        }
        $book->save();

        $book->categories()->detach();
        $book->categories()->attach($request->category);

        $book->categories()->sync($request->category);

        return redirect()->route('book.index')->with('status', 'buku berhasil ditambahkan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        $book->categories()->detach();
        if ($book->cover) {
            Storage::delete('public/' . $book->cover);
        }

        $book->delete();

        return redirect()->route('book.index')->with('status', 'Data berhasil dihapus');
    }
}
