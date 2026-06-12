@extends('layouts.app')

@section('content')
<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Product List</h2>
        <a href="/products/create" class="btn btn-info text-white fw-bold">create+</a>
    </div>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Price</th>
                <th>Qty</th>
                <th>Category</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($products as $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->price }}</td>
                <td>{{ $product->qty }}</td>
                <td>{{ $product->category->name ?? 'No Category' }}</td>
                <td>
                    <a href="/products/{{ $product->id }}">👁️</a> |
                    <a href="/products/{{ $product->id }}/edit">✏️</a> |
                    <form action="/products/{{ $product->id }}" method="POST" style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" style="border:none; background:none; cursor:pointer;">🗑️</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center">No products found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
