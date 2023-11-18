<!-- resources/views/orders/edit.blade.php -->

@extends('layouts.app')

@section('content')
    <h1>Edit Pesanan</h1>

    <form action="{{ route('orders.update', $order->order_id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Tambahkan input form sesuai dengan atribut yang diperlukan -->
        <div class="mb-3">
            <label for="product_id" class="form-label">ID Produk</label>
            <input type="text" class="form-control" id="product_id" name="product_id" value="{{ $order->product_id }}" required>
        </div>

        <div class="mb-3">
            <label for="user_id" class="form-label">ID User</label>
            <input type="text" class="form-control" id="user_id" name="user_id" value="{{ $order->user_id }}" required>
        </div>

        <!-- ...Tambahkan input form lainnya... -->

        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
    </form>

    <a href="{{ route('orders.index') }}" class="btn btn-secondary">Kembali ke Daftar Pesanan</a>
@endsection
