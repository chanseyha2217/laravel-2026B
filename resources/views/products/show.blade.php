@extends('layouts.app')

@section('content')
<div class="container mt-4" style="max-width: 500px">
    <h2>Product Detail</h2>

    <table class="table table-bordered">
        <tr><th>ID</th><td>{{ $product->id }}</td></tr>
        <tr><th>Name</th><td>{{ $product->name }}</td></tr>
        <tr><th>Price</th><td>{{ $product->price }}</td></tr>
        <tr><th>Qty</th><td>{{ $product->qty }}</td></tr>
        <tr><th>Category</th><td>{{ $product->category->name ?? 'No Category' }}</td></tr>
    </table>

    <a href="/products/{{ $product->id }}/edit" class="btn btn-primary">Edit</a>
    <a href="/products" class="btn btn-secondary">Back</a>
</div>
@endsection
