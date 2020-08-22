<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return response()->json($categories, 200);
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'category_name' => 'required|unique:categories',
        ]);

        Category::create([
            'category_name' => $request->category_name,
        ]);
        return  response()->json('Category created success', 201);
    }


    public function show(Category $category)
    {
        return response()->json($category, 200);
    }

    public function update(Request $request, Category $category)
    {
        $this->validate($request, [
            'category_name' => 'required|unique:categories,category_name,'.$category->id,
        ]);

        $category->category_name = $request->category_name;
        $category->save();
        return response()->json('successfully updated', 200);
    }


    public function destroy(Category $category)
    {
        $category->delete();
        return response()->json('deleted success', 200);
    }
}
