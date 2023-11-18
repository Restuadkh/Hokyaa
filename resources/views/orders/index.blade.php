<!-- resources/views/orders/index.blade.php -->

@extends('layouts.app')

@section('content')
    <h1>Daftar Pesanan</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>User</th>
                <th>Tanggal Pesanan</th>
                <th>Total Harga</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
                <tr>
                    <td>{{ $order->order_id }}</td>
                    <td>{{ $order->user->name }}</td>
                    <td>{{ $order->order_date }}</td>
                    <td>{{ $order->total_amount }}</td>
                    <td>{{ $order->order_status }}</td>
                    <td>
                        <a href="{{ route('orders.show', $order->order_id) }}" class="btn btn-info">Lihat</a>
                        <a href="{{ route('orders.edit', $order->order_id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('orders.destroy', $order->order_id) }}" method="POST" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus pesanan ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <a href="{{ route('orders.create') }}" class="btn btn-success">Buat Pesanan Baru</a>
@endsection
