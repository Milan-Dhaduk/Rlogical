
@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1>Edit Product</h1>
    <form action="{{ route('products.update', $product->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="title">Title*</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ $product->title }}" required>
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control">{{ $product->description }}</textarea>
        </div>

        <div class="form-group">
            <label for="price">Price*</label>
            <input type="number" name="price" id="price" class="form-control" step="0.01" value="{{ $product->price }}" required>
        </div>

        <div class="form-group">
            <label for="qty">Quantity*</label>
            <input type="number" name="qty" id="qty" class="form-control" value="{{ $product->qty }}" required>
        </div>

        <div class="form-group">
            <label for="categories">Categories*</label>
            <select name="categories[]" id="categories" class="form-control" multiple="multiple">
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ in_array($category->id, $product->categories->pluck('id')->toArray()) ? 'selected' : '' }}>
                        {{ $category->title }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="status">Status</label>
            <select name="status" id="status" class="form-control">
                <option value="active" {{ $product->status == 'active' ? 'selected' : '' }}>Active</option>
                <option value="inactive" {{ $product->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Update Product</button>
    </form>
</div>

@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#categories').select2();
    });
</script>
@endpush
