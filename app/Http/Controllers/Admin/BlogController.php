<?php

namespace App\Http\Controllers\Admin;

use App\Models\Blog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBlogRequest;
use App\Http\Requests\UpdateBlogRequest;
use App\Traits\FileUpload;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    use FileUpload;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blogs = Blog::with('image')->get();
        return view('blogs.index', compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('blogs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBlogRequest $request)
    {
        DB::beginTransaction();

        try {
            $blog = new Blog();
            $blog->title = $request->title;
            $blog->description = $request->description;
            $blog->save();
            $this->uploadImages($request, $blog);

            DB::commit();
            return redirect(route('blogs.index'))->with('message', 'Blog Created Successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Blog $blog)
    {
        return view('blogs.show', compact('blog'));
    }
    /**
     * Show the form for editing the specified resource.
     */

    public function edit(Blog $blog)
    {
        return view('blogs.edit', compact('blog'));
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(UpdateBlogRequest $request, Blog $blog)
    {
        DB::beginTransaction();
        try {
            $blog->title = $request->title;
            $blog->description = $request->description;
            $blog->save();

            $this->uploadImages($request, $blog);
            DB::commit();
            return redirect(route('blogs.index'))->with('message', 'Blog Updated Sucessfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors('error', $e->getMessage());
        }
    }

    public function destroy(Blog $blog)
    {
        $blog->delete();
        return redirect(route('blogs.index'))->with('message', 'Blog Trashed Successfully');
    }

    public function trash()
    {
        $trashedBlogs = Blog::with('image')->onlyTrashed()->get();
        return view('blogs.trashed', compact('trashedBlogs'));
    }

    public function restore($id)
    {
        $blog = Blog::withTrashed()->findOrFail($id);
        $blog->restore();
        return redirect()->back()->with('message', 'Blog Restored Successfully');
    }

    public function forceDelete($id)
    {
        $blog = Blog::withTrashed()->findOrFail($id);

        // Check if Blog has an image
        if ($blog->image()->exists()) {
            $directory = 'blogs/' . $blog->id;
            Storage::disk('public')->deleteDirectory($directory);
        }
        $blog->image()->delete();
        $blog->forceDelete();
        return redirect()->back()->with('message', 'Blog Permenantly Deleted Successfully');
    }
}
