<!-- resources/views/payments/create.blade.php -->

@extends('layouts.app')

@section('content')
    <h1>Buat Pembayaran Baru</h1>

    <form action="{{ route('payments.store') }}" method="POST">
        @csrf

        <!-- Tambahkan input form sesuai dengan atribut yang diperlukan -->
        <div class="mb-3">
            <label for="order_id" class="form-label">ID Pesanan</label>
            <input type="text" class="form-control" id="order_id" name="order_id" required>
        </div>

        <div class="mb-3">
            <label for="user_id" class="form-label">ID User</label>
            <input type="text" class="form-control" id="user_id" name="user_id" required>
        </div>

        <!-- ...Tambahkan input form lainnya... -->

        <button type="submit" class="btn btn-primary">Buat Pembayaran</button>
    </form>

    <a href="{{ route('payments.index') }}" class="btn btn-secondary">Kembali ke Daftar Pembayaran</a>
@endsection