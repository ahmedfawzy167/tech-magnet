<?php

namespace App\Http\Controllers\Admin;

use App\Models\Blog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BlogController extends Controller
{
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
    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required|string|between:2,100',
            'description' => 'required|string|max:1000',
            'image' => 'required|image|mimes:png,jpg,jpeg|max:2048',
        ]);

        $img = $request->file('image');
        $ext = $img->getClientOriginalExtension();
        $fileName = Date("Y-m-d-h-i-s") . '.' . $ext;
        $location = "public/";
        $img->storeAs($location, $fileName);

        $blog = new Blog();
        $blog->title = $request->title;
        $blog->description = $request->description;
        $blog->save();

        $blog->image()->create([
            'path' => $fileName,
            'imageable_id' => $blog->id,
            'imageable_type' => 'App\Models\Blog',
        ]);

        return redirect(route('blogs.index'))->with('message', 'Blog Created Successfully');
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

    public function update(Request $request, Blog $blog)
    {
        $request->validate([
            'title' => 'required|string|between:2,100',
            'description' => 'required|string|max:1000',
            'image' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
        ]);

        $blog->title = $request->title;
        $blog->description = $request->description;
        $blog->save();

        if ($request->hasFile('image')) {
            $img = $request->file('image');
            $ext = $img->getClientOriginalExtension();
            $fileName = Date("Y-m-d-h-i-s") . '.' . $ext;
            $location = "public/";
            $img->storeAs($location, $fileName);

            $blog->image()->update([
                'path' => $fileName,
                'imageable_id' => $blog->id,
                'imageable_type' => 'App\Models\Blog',
            ]);
        }

        return redirect(route('blogs.index'))->with('message', 'Blog Updated Successfully');
    }

    public function destroy(Blog $blog)
    {
        $blog->delete();
        return redirect(route('blogs.index'))->with('message', 'Blog Trashed Successfully');
    }

    public function trash()
    {
        $trashedBlogs = Blog::onlyTrashed()->get();
        return view('blogs.trashed', compact('trashedBlogs'));
    }

    public function restore($id)
    {
        $blog = Blog::withTrashed()->findOrFail($id);
        $blog->restore();
        return redirect()->route('blogs.index')->with('message', 'Blog Restored Successfully');
    }

    public function forceDelete($id)
    {
        $blog = Blog::withTrashed()->findOrFail($id);
        $blog->forceDelete();
        $blog->image()->delete();
        return redirect()->route('blogs.index')->with('message', 'Blog Permenantly Deleted Successfully');
    }
}
