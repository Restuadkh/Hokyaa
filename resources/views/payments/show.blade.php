<!-- resources/views/payments/show.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-md">
            <h2>Detail Pembayaran</h2>
        </div>
        
        <div class="card ">
            <i class="fas fa-caret-square-left"></i>
            <div class="card-body">
                <form action="{{ route('payments.store') }}" method="POST">

                    <h5 class="card-title">Order #{{ $order->order_id }}</h5>

                    <div class="mb-3">
                        <label for="order_id" class="form-label">Product</label>
                        <input type="text" class="form-control" id="product_id" name="product_id"
                            value="{{ $order->product->product_name }}" readonly>
                    </div>
                    
                    <div class="mb-3">
                        <label for="order_id" class="form-label">Events</label>
                        <input type="text" class="form-control" id="event_id" name="event_id"
                            value="{{ $order->event->event_name }}" readonly>
                    </div>

                    <div class="mb-3">
                        <label for="user_id" class="form-label">User</label>
                        <input type="text" class="form-control" id="user_id" name="user_id"
                            value="{{ $order->user->name }}" readonly>
                    </div> 
 
                    <div class="mb-3">
                        <label for="user_id" class="form-label">Address</label>
                        <input type="text" class="form-control" id="user_id" name="user_id"
                            value="{{ $order->shipping_address }}" readonly>
                    </div>

                    <div class="mb-3">
                        <label for="user_id" class="form-label">Total Pembayaran</label>
                        <input type="text" class="form-control" id="user_id" name="user_id"
                            value="Rp.{{ $order->total_amount }},-" readonly>
                    </div>
                    
                    <div class="col-sm m-1">
                        <button type="submit" class="btn btn-primary">Bayar Sekarang</button>
                    </div>

                </form>
            </div>
            <div class="card-footer contrainer">
                <div class="col-sm m-1">
                    <a href="{{ route('payments.index') }}" class="btn btn-primary">Kembali ke Daftar Pembayaran</a>
                </div>
            </div>
        </div>


    </div>
@endsection
