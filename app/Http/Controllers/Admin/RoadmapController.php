<?php

namespace App\Http\Controllers\Admin;

use App\Models\Roadmap;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRoadmapRequest;
use App\Http\Requests\UpdateRoadmapRequest;

class RoadmapController extends Controller
{
    public function index()
    {
        $roadmaps = Roadmap::all();
        return view('roadmaps.index', compact('roadmaps'));
    }

    public function create()
    {
        return view('roadmaps.create');
    }

    public function store(StoreRoadmapRequest $request)
    {
        $roadmap = new Roadmap();
        $roadmap->title = $request->title;
        $roadmap->description = $request->description;
        $roadmap->save();

        return redirect(route('roadmaps.index'))->with('message', 'Roadmap Created Successfully');
    }

    public function edit(Roadmap $roadmap)
    {
        return view('roadmaps.edit', compact('roadmap'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRoadmapRequest $request, Roadmap $roadmap)
    {
        $roadmap->update($request->validated());

        return redirect(route('roadmaps.index'))->with('message', 'Roadmap Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Roadmap $roadmap)
    {
        $roadmap->delete();
        return redirect(route('roadmaps.index'))->with('message', 'Roadmap Deleted Successfully');
    }
}
