<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class CategoryController extends Controller
{
    // 1. GET /api/categories — List all
    public function index(): JsonResponse
    {
        $categories = Category::all();

        return response()->json([
            'success' => true,
            'data'    => $categories
        ], Response::HTTP_OK); // 200
    }

    // 2. POST /api/categories — Create new
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'required|string',
            'is_active'   => 'sometimes|boolean',
        ]);

        $category = Category::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Category created successfully.',
            'data'    => $category
        ], Response::HTTP_CREATED); // 201
    }

    // 3. GET /api/categories/{id} — View one
    public function show(string $id): JsonResponse
    {
        $category = Category::findOrFail($id);

        return response()->json([
            'success' => true,
            'data'    => $category
        ], Response::HTTP_OK); // 200
    }

    // 4. PUT /api/categories/{id} — Update
    public function update(Request $request, string $id): JsonResponse
    {
        $category = Category::findOrFail($id);

        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'required|string',
            'is_active'   => 'sometimes|boolean',
        ]);

        $category->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Category updated successfully.',
            'data'    => $category
        ], Response::HTTP_OK); // 200
    }

    // 5. DELETE /api/categories/{id} — Delete
    public function destroy(string $id): JsonResponse
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return response()->json([
            'success' => true,
            'message' => 'Category deleted successfully.'
        ], Response::HTTP_OK); // 200
    }
}