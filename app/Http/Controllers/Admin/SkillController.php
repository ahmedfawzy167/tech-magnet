<?php

namespace App\Http\Controllers\Admin;

use App\Models\Skill;
use App\Models\SuperSkill;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

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
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|alpha|between:2,100',
            'description' => 'required|string|alpha|max:1000',
            'super_skill_id' => 'required|numeric:gt:0',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $skill = new Skill();
        $skill->title = $request->title;
        $skill->content = $request->content;
        $skill->super_skill_id = $request->super_skill_id;
        $skill->save();

        Session::flash('message', 'Skill is Created Successfully');
        return redirect(route('skills.index'));
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
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|alpha|between:2,100',
            'description' => 'required|string|alpha|max:1000',
            'super_skill_id' => 'required|numeric:gt:0',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $skill->title = $request->title;
        $skill->content = $request->content;
        $skill->super_skill_id = $request->super_skill_id;
        $skill->update();

        Session::flash('message', 'Skill is Updated Successfully');
        return redirect(route('skills.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Skill $skill)
    {
        $skill->delete();
        Session::flash('message', 'Skill is Deleted Successfully');
        return redirect(route('skills.index'));
    }
}
