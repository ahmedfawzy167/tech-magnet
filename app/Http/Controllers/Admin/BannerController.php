<?php

namespace App\Http\Controllers\Admin;

use App\Models\Banner;
use App\Models\Location;
use App\Traits\FileUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreBannerRequest;
use App\Http\Requests\UpdateBannerRequest;

class BannerController extends Controller
{
    use FileUpload;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $banners = Banner::with(['image','locations'])->get();
        return view('banners.index', compact('banners'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $locations = Location::all();
        return view('banners.create', compact('locations'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBannerRequest $request)
    {
        DB::beginTransaction();
        try {
            $banner = new Banner();
            $banner->name = $request->name;
            $banner->save();
            $banner->locations()->attach($request->locations);

            $this->uploadImages($request, $banner);
            DB::commit();
            return redirect()->route('banners.index')->with('message', 'Banner Created Successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['errors' => 'Error Creating Banner: ' . $e->getMessage()]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Banner $banner)
    {
        $locations = Location::all();
        return view('banners.edit', compact('locations','banner'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBannerRequest $request, Banner $banner)
    {
        DB::beginTransaction();
        try {
            $banner->update($request->validated());
            $banner->locations()->sync($request->locations);

            $this->uploadImages($request, $banner);
            DB::commit();
            return redirect()->route('banners.index')->with('message', 'Banner Updated Successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['errors' => 'Error Updating Banner: ' . $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Banner $banner)
    {
         // Check if Banner has image
          if ($banner->image()->exists()) {
            $directory = 'banners/' . $banner->id;
            Storage::disk('public')->deleteDirectory($directory);
        }

        $banner->locations()->detach();
        $banner->image()->delete();
        $banner->delete();
        return redirect()->route('banners.index')->with('message', 'Banner Deleted Successfully');

    }
}
