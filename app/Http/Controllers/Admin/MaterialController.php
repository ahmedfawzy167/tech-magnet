<?php

namespace App\Http\Controllers\Admin;

use App\Models\Course;
use App\Models\Material;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class MaterialController extends Controller
{
    public function create()
    {
        $courses = Course::all();
        return view('materials.create', compact('courses'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|between:2,50',
            'description' => 'required|max:500',
            'file'  => 'required|file|mimes:pdf|max:2048',
            'file_type'  => 'required|string',
            'course_id' => 'required|numeric:gt:0',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $file = $request->file('file');
        $fileName = $file->getClientOriginalName();
        $location = "public/materials";
        $file->storeAs($location, $fileName);

        $material = new Material();
        $material->title = $request->title;
        $material->description = $request->description;
        $material->file = $fileName;
        $material->file_type = $request->file_type;
        $material->course_id = $request->course_id;
        $material->save();

        Session::flash('message', 'Material Uploaded Successfully');
        return redirect(route('materials.index'));
    }

    public function index()
    {
        $materials = Material::with('course')->get();
        return view('materials.index', compact('materials'));
    }

    public function destroy(Material $material)
    {
        $material->delete();
        Session::flash('message', 'Material Deleted Successfully');
        return redirect()->route('materials.index');
    }
}
