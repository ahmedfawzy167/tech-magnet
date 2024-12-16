<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Traits\ApiResponder;

class CategoryController extends Controller
{
    use ApiResponder;

    public function index()
    {
        $categories = Category::with('courses')->get();
        return $this->success(CategoryResource::collection($categories));
    }

    public function show(Category $category)
    {
        if ($category != null) {
            return $this->success(new CategoryResource($category));
        } else {
            return $this->notFound("Category Not Found");
        }
    }
}
