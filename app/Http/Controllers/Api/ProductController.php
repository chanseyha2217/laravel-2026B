<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    // 1. GET /api/products — List all
    public function index(): JsonResponse
    {
        $products = Product::with('category')->get();

        return response()->json([
            'success' => true,
            'data'    => $products
        ], Response::HTTP_OK, [], JSON_PRETTY_PRINT);
    }

    // 2. POST /api/products — Create new
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name'        => 'required|string|max:255',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'price'       => 'required|numeric|min:0',
            'stock'       => 'required|integer|min:0',
            'is_active'   => 'sometimes|boolean',
        ]);

        // Handle image upload
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
        }

        $product = Product::create([
            'category_id' => $request->category_id,
            'name'        => $request->name,
            'image'       => $imagePath,
            'price'       => $request->price,
            'stock'       => $request->stock,
            'is_active'   => $request->is_active ?? true,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Product created successfully.',
            'data'    => $product->load('category')
        ], Response::HTTP_CREATED, [], JSON_PRETTY_PRINT);
    }

    // 3. GET /api/products/{id} — View one
    public function show(string $id): JsonResponse
    {
        $product = Product::with('category')->findOrFail($id);

        return response()->json([
            'success' => true,
            'data'    => $product
        ], Response::HTTP_OK, [], JSON_PRETTY_PRINT);
    }

    // 4. PUT /api/products/{id} — Update
    public function update(Request $request, string $id): JsonResponse
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name'        => 'required|string|max:255',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'price'       => 'required|numeric|min:0',
            'stock'       => 'required|integer|min:0',
            'is_active'   => 'sometimes|boolean',
        ]);

        // Handle new image upload
        if ($request->hasFile('image')) {
            // Delete old image
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $product->image = $request->file('image')->store('products', 'public');
        }

        $product->category_id = $request->category_id;
        $product->name        = $request->name;
        $product->price       = $request->price;
        $product->stock       = $request->stock;
        $product->is_active   = $request->is_active ?? $product->is_active;
        $product->save();

        return response()->json([
            'success' => true,
            'message' => 'Product updated successfully.',
            'data'    => $product->load('category')
        ], Response::HTTP_OK, [], JSON_PRETTY_PRINT);
    }

    // 5. DELETE /api/products/{id} — Delete
    public function destroy(string $id): JsonResponse
    {
        $product = Product::findOrFail($id);

        // Delete image from storage
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return response()->json([
            'success' => true,
            'message' => 'Product deleted successfully.'
        ], Response::HTTP_OK, [], JSON_PRETTY_PRINT);
    }
}
