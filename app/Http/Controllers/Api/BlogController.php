<?php

namespace App\Http\Controllers\Api;

use App\Models\Blog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\BlogResource;
use App\Http\Resources\BlogCollection;
use App\Traits\ApiResponder;

class BlogController extends Controller
{
    use ApiResponder;

    public function index()
    {
        $blogs = Blog::with('image')->get();
        return $this->success(BlogCollection::collection($blogs));
    }

    public function show(Blog $blog)
    {
        if ($blog != null) {
            return $this->success(new BlogResource($blog));
        } else {
            return $this->notFound("Blog Not Found");
        }
    }
}
