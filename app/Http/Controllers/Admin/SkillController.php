<?php

namespace App\Http\Controllers\Admin;

use App\Models\{Skill, SuperSkill};
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSkillRequest;
use App\Http\Requests\UpdateSkillRequest;

class SkillController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $skills = Skill::with('superSkill')->get();
        return view('skills.index', compact('skills'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $super_skills = SuperSkill::all();
        return view('skills.create', compact('super_skills'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSkillRequest $request)
    {
        $skill = new Skill();
        $skill->title = $request->title;
        $skill->content = $request->content;
        $skill->super_skill_id = $request->super_skill_id;
        $skill->save();

        return redirect(route('skills.index'))->with('message', 'Skill Created Successfully');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Skill $skill)
    {
        $super_skills = SuperSkill::all();
        return view('skills.edit', compact('skill', 'super_skills'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSkillRequest $request, Skill $skill)
    {
        $skill->update($request->validated());
        return redirect(route('skills.index'))->with('message', 'Skill Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Skill $skill)
    {
        $skill->delete();
        return redirect(route('skills.index'))->with('message', 'Skill Deleted Successfully');
    }
}
