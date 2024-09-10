<?php

namespace App\Http\Controllers\Admin;

use App\Models\{Course, Material};
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MaterialController extends Controller
{
    public function index()
    {
        $materials = Material::with('course')->get();
        return view('materials.index', compact('materials'));
    }

    public function create()
    {
        $courses = Course::all();
        return view('materials.create', compact('courses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|alpha|between:2,100',
            'description' => 'required|string|alpha|max:1000',
            'file'  => 'required|file|mimes:pdf|max:2048',
            'file_type'  => 'required|string',
            'course_id' => 'required|exists:courses,id',
        ]);


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

        return redirect(route('materials.index'))->with('message', 'Material Uploaded Successfully');
    }

    public function show(Material $material)
    {
        return view('materials.show', compact('material'));
    }

    public function destroy(Material $material)
    {
        $material->delete();
        return redirect()->route('materials.index')->with('message', 'Material Deleted Successfully');
    }
}
