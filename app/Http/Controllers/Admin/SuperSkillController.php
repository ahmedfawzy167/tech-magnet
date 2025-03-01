<?php

namespace App\Http\Controllers\Admin;

use App\Models\{SuperSkill, Course};
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSuperSkillRequest;
use App\Http\Requests\UpdateSuperSkillRequest;
use Illuminate\Validation\ValidationException;

class SuperSkillController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $super_skills = SuperSkill::with('course')->get();
        return view('superskills.index', compact('super_skills'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $courses = Course::all();
        return view('superskills.create', compact('courses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSuperSkillRequest $request)
    {
        $super_skill = new SuperSkill();
        $super_skill->name = $request->name;
        $super_skill->course_id = $request->course_id;
        $super_skill->save();

        return redirect(route('super-skills.index'))->with('message', 'Super Skill Created Successfully');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SuperSkill $superSkill)
    {
        $courses = Course::all();
        return view('superskills.edit', compact('superSkill', 'courses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSuperSkillRequest $request, SuperSkill $super_skill)
    {
        $super_skill->update($request->validated());
        return redirect(route('super-skills.index'))->with('message', 'Super Skill Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SuperSkill $super_skill)
    {
        $super_skill->delete();
        return redirect(route('super-skills.index'))->with('message', 'Super Skill Deleted Successfully');
    }
}
