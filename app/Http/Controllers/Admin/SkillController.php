<?php

namespace App\Http\Controllers\Admin;

use App\Models\{Skill, SuperSkill};
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


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
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|between:2,100',
            'content' => 'required|string|max:1000',
            'super_skill_id' => 'required|exists:super_skills,id',
        ]);


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
    public function update(Request $request, Skill $skill)
    {
        $request->validate([
            'title' => 'required|string|between:2,100',
            'content' => 'required|string|max:1000',
            'super_skill_id' => 'required|exists:super_skills,id',
        ]);


        $skill->title = $request->title;
        $skill->content = $request->content;
        $skill->super_skill_id = $request->super_skill_id;
        $skill->update();

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
