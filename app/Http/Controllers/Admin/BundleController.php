<?php

namespace App\Http\Controllers\Admin;

use App\Models\Bundle;
use App\Models\Course;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreBundleRequest;
use App\Http\Requests\UpdateBundleRequest;
use App\Traits\FileUpload;

class BundleController extends Controller
{
    use FileUpload;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bundles = Bundle::with(['courses', 'image'])->get();
        return view('bundles.index', compact('bundles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $courses = Course::all();
        return view('bundles.create', compact('courses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBundleRequest $request)
    {
        DB::beginTransaction();
        try {
            $bundle = new Bundle();
            $bundle->name = $request->name;
            $bundle->description = $request->description;
            $bundle->price = $request->price;
            $bundle->save();
            $bundle->courses()->attach($request->courses);

            $this->uploadImages($request, $bundle);
            DB::commit();
            return redirect()->route('bundles.index')->with('message', 'Bundle Created Successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['errors' => 'Error Creating Bundle: ' . $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Bundle $bundle)
    {
        $bundle->load(["image", "courses"]);
        return view('bundles.show', compact('bundle'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Bundle $bundle)
    {
        $courses = Course::all();
        return view('bundles.edit', compact('bundle', 'courses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBundleRequest $request, Bundle $bundle)
    {
        DB::beginTransaction();
        try {
            $bundle->update($request->validated());
            $bundle->courses()->sync($request->courses);

            $this->uploadImages($request, $bundle);
            DB::commit();
            return redirect()->route('bundles.index')->with('message', 'Bundle Updated Successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['errors' => 'Error Updating Bundle: ' . $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bundle $bundle)
    {
        $bundle->delete();
        return redirect()->route('bundles.index')->with('message', 'Bundle Deleted Successfully');
    }

    public function trash()
    {
        $bundles = Bundle::with(['courses', 'image'])->onlyTrashed()->get();
        return view('bundles.trashed', compact('bundles'));
    }

    public function restore($id)
    {
        $bundle = Bundle::withTrashed()->findOrFail($id);
        $bundle->restore();

        return redirect()->back()->with('message', 'Bundle Restored Successfully');
    }

    public function forceDelete($id)
    {
        $bundle = Bundle::withTrashed()->findOrFail($id);

        // Check if Bundle has Courses
        if ($bundle->courses()->count() > 0) {
            return redirect()->back()->withErrors([
                'error' => 'Cannot Delete Bundle while it has Associated Courses!.'
            ]);
        }

        // Check if Bundle has an image
        if ($bundle->image()->exists()) {
            $directory = 'bundles/' . $bundle->id;
            Storage::disk('public')->deleteDirectory($directory);
        }

        $bundle->courses()->detach();
        $bundle->image()->delete();
        $bundle->forceDelete();

        return redirect()->back()->with('message', 'Bundle Permanently Deleted');
    }
}
