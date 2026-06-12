@extends('layouts.app')

@section('content')
<div class="container mt-4" style="max-width: 500px">
    <h2>Create Product</h2>

    <form action="/products" method="POST">
        @csrf
        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Price</label>
            <input type="number" name="price" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Qty</label>
            <input type="number" name="qty" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Category</label>
            <select name="category_id" class="form-control" required>
                <option value="">-- Select Category --</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-success">Save</button>
        <a href="/products" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
