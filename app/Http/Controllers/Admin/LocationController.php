<?php

namespace App\Http\Controllers\Admin;

use App\Models\Location;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLocationRequest;
use App\Http\Requests\UpdateLocationRequest;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $locations = Location::select('id','name')->get();
        return view('locations.index', compact('locations'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLocationRequest $request, Location $location)
    {
        $location::create($request->validated());
        return redirect(route('locations.index'))->with('message', 'Location Created Successfully');
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLocationRequest $request, Location $location)
    {
        $location->update($request->validated());
        return redirect(route('locations.index'))->with('message', 'Location Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Location $location)
    {
        $location->banners()->detach();
        $location->delete();
        return redirect()->route('locations.index')->with('message', 'Location Deleted Successfully');

    }
}
