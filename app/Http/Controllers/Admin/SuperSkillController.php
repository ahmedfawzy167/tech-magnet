<?php

namespace App\Http\Controllers\Admin;
use App\Models\SuperSkill;
use App\Models\Course;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

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
        return view('superskills.create',compact('courses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=> ['required','string','max:100'],
            'course_id' => 'required|numeric:gt:0'
        ]);

        $super_skill = new SuperSkill();
        $super_skill->name = $request->name;
        $super_skill->course_id = $request->course_id;
        $super_skill->save();

        Session::flash('message','Super Skill is Created Successfully');
        return redirect(route('superskills.index'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $superSkill = SuperSkill::findOrFail($id);
        $courses = Course::all();
        return view('superskills.edit',compact('superSkill','courses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        $request->validate([
            'name'=> ['required','string','max:100'],
            'course_id' => 'required|numeric:gt:0'
        ]);

        $superSkill = SuperSkill::findOrFail($id);
        $superSkill->name = $request->name;
        $superSkill->course_id = $request->course_id;
        $superSkill->save();

        Session::flash('message','Super Skill is Updated Successfully');
        return redirect(route('superskills.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SuperSkill $super_skill)
    {
        $super_skill->delete();
        Session::flash('message','Super Skill is Deleted Successfully');
        return redirect(route('superskills.index'));
    }
}
