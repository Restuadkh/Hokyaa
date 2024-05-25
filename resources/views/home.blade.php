@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center pb-5">
            <hr>
            <h3 class="pb-2">Events Availabled</h3>
            @foreach ($events as $event)
                <div class="col-3">
                    <div class="card text-left border-0 shadow">
                        @foreach ($event->photos as $photo)
                            <img class="card-img-top cropped-img" src="{{ asset('storage/' . $photo->photo_path) }}" alt="Product Photo" style="width:100%" height="200px">
                        @endforeach
                        <div class="card-body">
                            <h4 class="card-title">{{ $event->event_name }}</h4>
                            <p class="card-text">{{ $event->event_description }}</p>
                            <p class="card-text">{{ $event->event_date }}</p>
                            <p class="card-text">{{ $event->event_time }}</p>
                            <p class="card-text">{{ $event->event_price }}</p>
                        </div>
                    </div>
                </div>
            @endforeach 
        </div>
        <div class="row justify-content-center pb-5">
            <hr>
            <h3 class="pb-2">Product Availabled</h3>
            @foreach ($products as $product)
                <div class="col-3">
                    <div class="card text-left border-0 shadow">
                        @foreach ($product->photos as $photo)
                            <img class="card-img-top cropped-img" src="{{ asset('storage/' . $photo->photo_path) }}" alt="Product Photo" style="width:100%" height="200px">
                        @endforeach
                        <div class="card-body">
                            <h4 class="card-title">{{ $product->product_name }}</h4>
                            <p class="card-text">{{ $product->description }}</p>
                            <p class="card-text">{{ $product->price }}</p>
                            <p class="card-text">{{ $product->disc_price }}</p> 
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
