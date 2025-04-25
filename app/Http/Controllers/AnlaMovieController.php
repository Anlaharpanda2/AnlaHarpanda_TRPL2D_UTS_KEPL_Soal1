<?php

namespace App\Http\Controllers;

use App\Models\AnlaMovie;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class AnlaMovieController extends Controller
{
    public function index()
    {
        $movies = $this->getMoviesWithSearch()->paginate(6)->withQueryString();
        return view('homepage', compact('movies'));
    }

    public function detail($id)
    {
        $movie = AnlaMovie::find($id);
        return view('detail', compact('movie'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('input', compact('categories'));
    }

    public function store(Request $request)
    {
        $this->validateStoreRequest($request);
        $fileName = $this->uploadMovieCover($request);

        AnlaMovie::create([
            'id' => $request->id,
            'judul' => $request->judul,
            'category_id' => $request->category_id,
            'sinopsis' => $request->sinopsis,
            'tahun' => $request->tahun,
            'pemain' => $request->pemain,
            'foto_sampul' => $fileName,
        ]);

        return redirect('/')->with('success', 'Data berhasil disimpan');
    }

    public function data()
    {
        $movies = AnlaMovie::latest()->paginate(10);
        return view('data-movies', compact('movies'));
    }

    public function form_edit($id)
    {
        $movie = AnlaMovie::find($id);
        $categories = Category::all();
        return view('form-edit', compact('movie', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $this->validateUpdateRequest($request);
        $movie = AnlaMovie::findOrFail($id);

        if ($request->hasFile('foto_sampul')) {
            $this->deleteOldCoverImage($movie);
            $fileName = $this->uploadMovieCover($request);
            $movie->update(array_merge($request->only(['judul', 'sinopsis', 'category_id', 'tahun', 'pemain']), ['foto_sampul' => $fileName]));
        } else {
            $movie->update($request->only(['judul', 'sinopsis', 'category_id', 'tahun', 'pemain']));
        }

        return redirect('/movies/data')->with('success', 'Data berhasil diperbarui');
    }

    public function delete($id)
    {
        $movie = AnlaMovie::findOrFail($id);
        $this->deleteOldCoverImage($movie);
        $movie->delete();

        return redirect('/movies/data')->with('success', 'Data berhasil dihapus');
    }

    private function getMoviesWithSearch()
    {
        $query = AnlaMovie::latest();
        if ($search = request('search')) {
            $query->where('judul', 'like', '%' . $search . '%')
                ->orWhere('sinopsis', 'like', '%' . $search . '%');
        }
        return $query;
    }

    private function validateStoreRequest(Request $request)
    {
        $request->validate([
            'id' => ['required', 'string', 'max:255', 'unique:movies'],
            'judul' => 'required|string|max:255',
            'category_id' => 'required|integer',
            'sinopsis' => 'required|string',
            'tahun' => 'required|integer',
            'pemain' => 'required|string',
            'foto_sampul' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    }

    private function validateUpdateRequest(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'category_id' => 'required|integer',
            'sinopsis' => 'required|string',
            'tahun' => 'required|integer',
            'pemain' => 'required|string',
            'foto_sampul' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    }

    private function uploadMovieCover(Request $request)
    {
        $fileName = Str::uuid()->toString() . '.jpg';
        $request->file('foto_sampul')->move(public_path('images'), $fileName);
        return $fileName;
    }

    private function deleteOldCoverImage($movie)
    {
        if (File::exists(public_path('images/' . $movie->foto_sampul))) {
            File::delete(public_path('images/' . $movie->foto_sampul));
        }
    }
}