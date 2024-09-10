<?php

namespace App\Http\Controllers\Admin;

use App\Models\Objective;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreObjectiveRequest;
use App\Http\Requests\UpdateObjectiveRequest;

class ObjectiveController extends Controller
{
    public function index()
    {
        $objectives = DB::table('objectives')->get();
        return view('objectives.index', compact('objectives'));
    }

    public function create()
    {
        return view('objectives.create');
    }

    public function store(StoreObjectiveRequest $request)
    {
        $request->validated();

        $objective = new Objective();
        $objective->name = $request->name;
        $objective->save();

        return redirect(route('objectives.index'))->with('message', 'Objective Created Successfully');
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

        return redirect(route('objectives.index'))->with('message', 'Objective Updated Successfully');
    }

    public function destroy(Objective $objective)
    {
        $objective->delete();
        return redirect(route('objectives.index'))->with('message', 'Objective Deleted Successfully');
    }
}
