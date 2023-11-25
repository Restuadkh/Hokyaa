<!-- resources/views/products/index.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Product List</h1>
        <a href="{{ route('products.create') }}" class="btn btn-primary">Create Product</a>
        <table class="table mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Discounted Price</th>
                    <th>Stock Quantity</th>
                    <th>Category</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($products as $product)
                    <tr>
                        <td>{{ $product->product_id }}</td>
                        <td>
                            @foreach ($product->photos as $photo)
                                <img src="{{ asset($photo->photo_path) }}" alt="Product Photo">
                            @endforeach
                        </td>
                        <td>{{ $product->product_name }}</td>
                        <td>{{ $product->description }}</td>
                        <td>{{ $product->price }}</td>
                        <td>{{ $product->disc_price }}</td>
                        <td>{{ $product->stock_quantity }}</td>
                        <td>{{ $product->category }}</td>
                        <td>{{ $product->created_at }}</td>
                        <td>{{ $product->updated_at }}</td>
                        <td>
                            <a href="{{ route('products.edit', $product->product_id) }}" class="btn btn-info btn-sm">Edit</a>
                            <form action="{{ route('products.destroy', $product->product_id) }}" method="post"
                                class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="10">No products found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
