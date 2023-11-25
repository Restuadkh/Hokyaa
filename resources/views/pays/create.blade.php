<!-- resources/views/pays/create.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Tambah Pay</h2>
        <form action="{{ route('pays.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="biaya">Biaya:</label>
                <input type="text" class="form-control" id="biaya" name="biaya" required>
            </div>
            <div class="form-group">
                <label for="deskripsi">Deskripsi:</label>
                <input type="text" class="form-control" id="deskripsi" name="deskripsi" required>
            </div> 
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
@endsection
