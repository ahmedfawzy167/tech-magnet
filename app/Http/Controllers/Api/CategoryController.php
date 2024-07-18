<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return response()->json($categories);
    }

    public function show(Category $category)
    {
        if ($category != null) {
            return new CategoryResource($category);
        } else {
            return response()->json([
                "status"  => "Error",
                "message"  => "Category Not Found"
            ], 404);
        }
    }
}
