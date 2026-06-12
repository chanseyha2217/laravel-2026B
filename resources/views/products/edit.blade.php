@extends('layouts.app')

@section('content')
<div class="container mt-4" style="max-width: 500px">
    <h2>Edit Product</h2>

    <form action="/products/{{ $product->id }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" class="form-control" value="{{ $product->name }}" required>
        </div>
        <div class="mb-3">
            <label>Price</label>
            <input type="number" name="price" class="form-control" value="{{ $product->price }}" required>
        </div>
        <div class="mb-3">
            <label>Qty</label>
            <input type="number" name="qty" class="form-control" value="{{ $product->qty }}" required>
        </div>
        <div class="mb-3">
            <label>Category</label>
            <select name="category_id" class="form-control" required>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}"
                        {{ $product->category_id == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="/products" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
