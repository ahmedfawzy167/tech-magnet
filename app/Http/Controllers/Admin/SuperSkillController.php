<?php

namespace App\Http\Controllers\Admin;

use App\Models\Course;
use App\Models\SuperSkill;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
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
    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => ['required', 'string', 'max:100'],
                'course_id' => 'required|exists:courses,id'
            ]);

            $super_skill = new SuperSkill();
            $super_skill->name = $request->name;
            $super_skill->course_id = $request->course_id;
            $super_skill->save();

            Session::flash('message', 'Super Skill is Created Successfully');
            return redirect(route('super-skills.index'));
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        }
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
    public function update(Request $request, SuperSkill $super_skill)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'course_id' => 'required|numeric:gt:0'
        ]);

        $super_skill->name = $request->name;
        $super_skill->course_id = $request->course_id;
        $super_skill->update();

        Session::flash('message', 'Super Skill is Updated Successfully');
        return redirect(route('super-skills.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SuperSkill $super_skill)
    {
        $super_skill->delete();
        Session::flash('message', 'Super Skill is Deleted Successfully');
        return redirect(route('super-skills.index'));
    }
}
