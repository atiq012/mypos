<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Auth;
class CategoryController extends Controller
{
    public function index()
    {
        $data = Category::all();
        
        return response()->json($data, 200);
    }

    public function create(Request $request)
    {
        $data = Category::create($request->all());
        return response()->json($data, 201);
    }

    public function view(Category $category)
    {
        return response()->json($category, 200);
    }

    public function update(Category $category,Request $request)
    {
        
        $data = $category->update($request->all());

        return response()->json($category, 202);
    }

    public function delete(Category $category,Request $request)
    {
        $category->delete();
        return response()->json(null, 204);
    }
}
