<?php

namespace App\Http\Controllers\Admin;

use App\Models\Blog;
use App\Models\Image;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blogs = Cache::rememberForever('blogs', function () {
            return Blog::with('image')->get();
        });
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
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|between:2,100',
            'description' => 'required|string|max:1000',
            'image' => 'required|image|mimes:png,jpg,jpeg|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $blog = new Blog();
        $blog->title = $request->title;
        $blog->description = $request->description;
        $blog->save();

        $img = $request->file('image');
        $ext = $img->getClientOriginalExtension();
        $fileName = Date("Y-m-d-h-i-s") . '.' . $ext;
        $location = "public/";
        $img->storeAs($location, $fileName);

        $image = new Image();
        $image->path = $fileName;
        $image->imageable_id = $blog->id;
        $image->imageable_type = 'App\Models\Blog';
        $image->save();

        Session::flash('message', 'Blog Created Successfully');
        return redirect(route('blogs.index'));
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
        return view('blogs.edit', get_defined_vars());
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, Blog $blog)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|between:2,100',
            'description' => 'required|string|max:1000',
            'image' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $blog->title = $request->title;
        $blog->description = $request->description;
        $blog->update();

        $img = $request->file('image');
        $ext = $img->getClientOriginalExtension();
        $fileName = Date("Y-m-d-h-i-s") . '.' . $ext;
        $location = "public/";
        $img->storeAs($location, $fileName);

        $image = new Image();
        $image->path = $fileName;
        $image->imageable_id = $blog->id;
        $image->imageable_type = 'App\Models\Blog';
        $image->save();

        Session::flash('message', 'Blog Updated Successfully');
        return redirect(route('blogs.index'));
    }

    public function destroy(Blog $blog)
    {
        $blog->delete();
        Session::flash('message', 'Blog Trashed Successfully');
        return redirect(route('blogs.index'));
    }

    public function trash()
    {
        $trashedBlogs = Blog::onlyTrashed()->get();
        return view('blogs.trashed', compact('trashedBlogs'));
    }

    public function restore($id)
    {
        $blog = Blog::onlyTrashed()->findOrFail($id);
        $blog->restore();
        return redirect()->route('blogs.index')->with('message', 'Blog Restored Successfully');
    }

    public function forceDelete($id)
    {
        $blog = Blog::onlyTrashed()->findOrFail($id);
        $blog->forceDelete();
        return redirect()->route('blogs.index')->with('message', 'Blog Permenantly Deleted Successfully');
    }
}
