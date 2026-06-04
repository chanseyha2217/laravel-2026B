<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function index()
    {
        // raw sql
        // $categories = DB::select('SELECT * FROM categories');
        // Query Builder 
        // $categories = DB::table('categories')->get();
        // Eloquent ORM:
        $categories = Category::orderBy('id', 'desc')->get();
        // dd($categories);
        return view('categories.list', compact('categories'));
    }

    public function create()
    {
        // dd(112);
        return view('categories.create');
    }

    public function store()
    {
        // dd(111);
        // dd(request()->all());
        Category::create(
            [
                'name' => request()->name,
                'dec' => request()->dec,
            ]
        );
        // return view('categories.list'); don't like this
        return redirect('/categories');
    }

    public function edit($id)
    {
        $category = Category::find($id);
        // dd( $category );
        return view('categories.edit', compact('category'));
    }

    public function update($id)
    {
        // dd($id);
        // dd(request()->all());
        $category = Category::find($id);
        $category->update(
            [
                'name' => request()->name,
                'dec' => request()->dec,
            ]
        );
        return redirect('/categories');
    }
    public function destroy($id)
    {
        // dd($id);
        $category = Category::find($id);
        $category->delete();
        return redirect('/categories');
    }
}
