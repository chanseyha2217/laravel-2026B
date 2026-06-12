<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->get();
        return view('products.list', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required',
            'price'       => 'required|numeric',
            'qty'         => 'required|integer',
            'category_id' => 'required',
        ]);

        Product::create($request->all());
        return redirect('/products');
    }

    public function show($id)
    {
        $product = Product::with('category')->findOrFail($id);
        return view('products.show', compact('product'));
    }

    public function edit($id)
    {
        $product    = Product::findOrFail($id);
        $categories = Category::all();
        return view('products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name'        => 'required',
            'price'       => 'required|numeric',
            'qty'         => 'required|integer',
            'category_id' => 'required',
        ]);

        Product::findOrFail($id)->update($request->all());
        return redirect('/products');
    }

    public function destroy($id)
    {
        Product::findOrFail($id)->delete();
        return redirect('/products');
    }
}
