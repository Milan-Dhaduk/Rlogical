@extends('layouts.user')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-md-6">
        </div>
        <div class="col-md-6">
            <h1>{{ $product->title }}</h1>
            <p>{{ $product->description }}</p>
            <p>Price: ${{ number_format($product->price, 2) }}</p>
            <form action="{{ route('cart.add', $product->id) }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="qty">Quantity</label>
                    <input type="number" id="qty" name="qty" class="form-control" min="1" value="1" required>
                </div>
                <button type="submit" class="btn btn-success mt-3">Add to Cart</button>
            </form>
        </div>
    </div>
</div>
@endsection
