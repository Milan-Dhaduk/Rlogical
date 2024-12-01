@extends('layouts.user')

@section('content')
<div class="container mt-4">

    <a href="{{route('cart.index')}}" class="btn btn-dark ">Cart</a>

    <h1>Products</h1>
    <div class="row">
        @foreach($products as $product)
            <div class="col-md-3 mb-4">
                <div class="card">
                    {{-- <img src="{{ asset('storage/'.$product->image) }}" class="card-img-top" alt="{{ $product->title }}"> --}}
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->title }}</h5>
                        <p class="card-text">{{ $product->description }}</p>
                        <p class="card-text">Price: ${{ number_format($product->price, 2) }}</p>
                        <a href="{{ route('products.view', $product->id) }}" class="btn btn-primary">View Details</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
