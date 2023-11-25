<!-- resources/views/pays/index.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Data Pays</h2>
        <a href="{{ route('pays.create') }}" class="btn btn-primary">Tambah Pay</a>
        <table class="table mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Biaya</th>
                    <th>Deskripsi</th>
                    <th>Status</th>
                    <th>Pay Link</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pays as $pay)
                    <tr>
                        <td>{{ $pay->pay_id }}</td>
                        <td>{{ $pay->biaya }}</td>
                        <td>{{ $pay->deskripsi }}</td>
                        <td>{{ $pay->status }}</td>
                        <td>{{ $pay->pay_link }}</td>
                        <td>
                            <a href="{{ route('pays.show', $pay->pay_id) }}" class="btn btn-info">Lihat</a>
                            <a href="{{ route('pays.edit', $pay->pay_id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('pays.destroy', $pay->pay_id) }}" method="POST" style="display:inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
