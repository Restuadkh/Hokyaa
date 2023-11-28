<!-- resources/views/pays/create.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-md">
            <h2>Tambah Pay</h2>
        </div> 
        <form action="{{ route('pays.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="biaya">Biaya:</label>
                <input type="text" class="form-control" id="biaya" name="biaya" required>
            </div>
            <div class="form-group">
                <label for="descripsi">descripsi:</label>
                <input type="text" class="form-control" id="descripsi" name="descripsi" required>
            </div> 
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
@endsection
