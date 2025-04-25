@extends('layout.template')
@section('title', 'Data Movie')
@section('content')
<h1>Data-Movie</h1>
<table class="table table-hover">
    <thead>
      <tr>
        <th>No</th>
        <th>Judul</th>
        <th>Kategori</th>
        <th>Tahun</th>
        <th>Pemain</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($movies as $movie)
        <tr>
            <th>{{ $loop->iteration }}</th>
            <td>{{ $movie->judul }}</td>
            <td>{{ $movie->category->nama_kategori }}</td>
            <td>{{ $movie->tahun }}</td>
            <td>{{ $movie->pemain }}</td>
            <td>
                <a href="/movies/edit/{{ $movie['id'] }}" class="btn btn-warning">Edit</a>
                <a href="{{ route('movies.delete', ['id' => $movie->id]) }}" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<div class="d-flex justify-content-center">{{ $movies->links() }}</div>
@endsection