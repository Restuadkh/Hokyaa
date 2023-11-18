<!-- resources/views/orders/create.blade.php -->

@extends('layouts.app')

@section('content')
    <h1>Buat Pesanan Baru</h1>

    <form action="{{ route('orders.store') }}" method="POST">
        @csrf

        <!-- Tambahkan input form sesuai dengan atribut yang diperlukan -->
        <div class="mb-3">
            <label for="product_id" class="form-label">ID Produk</label>
            <input type="text" class="form-control" id="product_id" name="product_id" required>
        </div>

        <div class="mb-3">
            <label for="user_id" class="form-label">ID User</label>
            <input type="text" class="form-control" id="user_id" name="user_id" required>
        </div>

        <!-- ...Tambahkan input form lainnya... -->

        <button type="submit" class="btn btn-primary">Buat Pesanan</button>
    </form>

    <a href="{{ route('orders.index') }}" class="btn btn-secondary">Kembali ke Daftar Pesanan</a>
@endsection
