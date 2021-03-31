<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        $old_cat = Category::all();
        return view('categories/create', compact('old_cat'));
    }

    public function store(Request $request)
    {
        request()->validate([
            'category_name' => ['required', 'unique:categories']
        ]);

        $category = new Category;
        $category->category_name = request('category_name');
        $category->save();
        return back()->with('msg', 'Your Data Is Added!');

    }

    public function show(Category $category)
    {
        //
    }

    public function edit($id)
    {
        $category = Category::find($id);
        return view('categories.edit', compact('category'));
    }

    public function update($id)
    {
        $category = Category::find($id);
        $category->category_name = request('category_name');
        $category->save();

        return redirect(route('category.create'));
    }

    public function delete($id)
    {

        $category = Category::findOrFail($id);
        $category->delete();

        return redirect(route('category.create'));

    }
}
