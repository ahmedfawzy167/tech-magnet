<?php

namespace App\Http\Controllers\Admin;

use App\Models\Roadmap;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class RoadmapController extends Controller
{
    public function index()
    {
        $roadmaps = Roadmap::all();
        return view('roadmaps.index', compact('roadmaps'));
    }

    public function edit($id)
    {
        $roadmap = Roadmap::findOrFail($id);
        return view('roadmaps.edit',compact('roadmap'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|between:2,150',
            'description' => 'required|string|max:800',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $roadmap = Roadmap::findOrFail($id);
        $roadmap->title = $request->title;
        $roadmap->description = $request->description;
        $roadmap->save();

        Session::flash('message','Roadmap is Updated Successfully');
        return redirect(route('roadmaps.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $roadmap = Roadmap::findOrFail($id);
        $roadmap->delete();
        Session::flash('message','Roadmap is Deleted Successfully');
        return redirect(route('roadmaps.index'));
    }
}
