<!-- resources/views/payments/show.blade.php -->

@extends('layouts.app')

@section('content')
    <h1>Detail Pembayaran</h1>

    <div>
        <strong>ID:</strong> {{ $payment->payment_id }}<br>
        <strong>ID Pesanan:</strong> {{ $payment->order_id }}<br>
        <strong>ID User:</strong> {{ $payment->user_id }}<br>
        <strong>Tanggal Pembayaran:</strong> {{ $payment->payment_date }}<br>
        <strong>Jumlah Pembayaran:</strong> {{ $payment->payment_amount }}<br>
        <strong>Status Pembayaran:</strong> {{ $payment->payment_status }}<br>
        <strong>Metode Pembayaran:</strong> {{ $payment->payment_method }}<br>
        <strong>ID Transaksi:</strong> {{ $payment->transaction_id }}<br>
        <!-- Tambahkan atribut pembayaran lainnya sesuai kebutuhan -->
    </div>

    <a href="{{ route('payments.index') }}" class="btn btn-primary">Kembali ke Daftar Pembayaran</a>
@endsection
