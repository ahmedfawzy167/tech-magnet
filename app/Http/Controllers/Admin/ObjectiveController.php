<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\UpdateObjectiveRequest;
use App\Http\Controllers\Controller;
use App\Models\Objective;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ObjectiveController extends Controller
{
    public function index()
    {
        $objectives = Objective::all();
        return view('objectives.index', compact('objectives'));
    }

    public function show(Objective $objective)
    {
        $courses = $objective->courses;
        return view('objectives.show', get_defined_vars());
    }

    public function edit(Objective $objective)
    {
        return view('objectives.edit', compact('objective'));
    }

    public function update(UpdateObjectiveRequest $request, Objective $objective)
    {
        $request->validated();
        $objective->name = $request->name;
        $objective->save();

        Session::flash('message', 'Objective is Updated Successfully!');
        return redirect(route('objectives.index'));
    }

    public function destroy(Objective $objective)
    {
        $objective->delete();
        Session::flash('message', 'Objective is Deleted Successfully');
        return redirect(route('objectives.index'));
    }
}
