<?php

namespace App\Http\Controllers\Api;

use App\Models\Blog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\BlogResource;
use App\Http\Resources\BlogCollection;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::with('image')->get();
        return BlogCollection::collection($blogs);
    }

    public function show(Blog $blog)
    {
        if ($blog != null) {
            return new BlogResource($blog);
        } else {
            return response()->json([
                "status"  => "Error",
                "message"  => "Blog Not Found"
            ], 404);
        }
    }
}
