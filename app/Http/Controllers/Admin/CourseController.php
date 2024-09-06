<?php

namespace App\Http\Controllers\Admin;

use App\Models\Course;
use App\Models\Category;
use App\Models\Objective;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Cache::rememberForever('courses', function () {
            return Course::with(['category', 'objective', 'image'])->get();
        });
        return view('courses.index', compact('courses'));
    }

    public function show(Course $course)
    {
        $course->load(['category', 'objective', 'image']);
        return view('courses.show', compact('course'));
    }

    public function create()
    {
        $categories = Category::all();
        $objectives = Objective::all();
        return view('courses.create', get_defined_vars());
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|between:5,50',
            'description' => 'required|string|max:1000',
            'price' => ['required', 'regex:/^\d+(\.\d{1,2})?$/', 'gt:0'],
            'hours' => 'required|numeric:gt:0',
            'category_id' => 'required|exists:categories,id',
            'objective_id' => 'required|exists:objectives,id',
            'image'       => 'required|image|mimes:jpeg,png,jpg|max:3000'
        ]);

        $course = new Course();
        $course->name = $request->name;
        $course->description = $request->description;
        $course->price = $request->price;
        $course->hours = $request->hours;
        $course->category_id = $request->category_id;
        $course->objective_id = $request->objective_id;
        $course->save();

        $img = $request->file('image');
        $ext = $img->getClientOriginalExtension();
        $fileName = Date("Y-m-d-h-i-s") . '.' . $ext;
        $location = "public/";
        $img->storeAs($location, $fileName);

        $course->image()->create([
            'path' => $fileName,
            'imageable_id' => $course->id,
            'imageable_type' => 'App\Models\Course',
        ]);

        return redirect(route('courses.index'))->with('message', 'Course Created Successfully');
    }


    public function edit(Course $course)
    {
        $categories = Category::all();
        $objectives = Objective::all();
        return view('courses.edit', get_defined_vars());
    }

    public function update(Request $request, Course $course)
    {
        $request->validate([
            'name' => 'required|string|between:5,50',
            'description' => 'required|string|max:1000',
            'price' => ['required', 'regex:/^\d+(\.\d{1,2})?$/', 'gt:0'],
            'hours' => 'required|numeric:gt:0',
            'category_id' => 'required|exists:categories,id',
            'objective_id' => 'required|exists:objectives,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:3000'
        ]);

        $course->name = $request->name;
        $course->description = $request->description;
        $course->price = $request->price;
        $course->hours = $request->hours;
        $course->category_id = $request->category_id;
        $course->objective_id = $request->objective_id;
        $course->save();

        if ($request->hasFile('image')) {
            $img = $request->file('image');
            $ext = $img->getClientOriginalExtension();
            $fileName = Date("Y-m-d-h-i-s") . '.' . $ext;
            $location = "public/";
            $img->storeAs($location, $fileName);

            $course->image()->update([
                'path' => $fileName,
                'imageable_id' => $course->id,
                'imageable_type' => 'App\Models\Course',
            ]);
        }

        return redirect(route('courses.index'))->with('message', 'Course Updated Sucessfully');
    }

    public function destroy(Course $course)
    {
        $course->delete();
        return redirect(route('courses.index'))->with('message', 'Course Trashed Sucessfully');
    }

    public function trash()
    {
        $trashedCourses = Course::onlyTrashed()->with(['category', 'image', 'objective'])->get();
        return view('courses.trashed', compact('trashedCourses'));
    }

    public function restore($id)
    {
        $course = Course::onlyTrashed()->findOrFail($id);
        $course->restore();
        return redirect()->route('courses.index')->with('message', 'Course Restored Successfully');
    }

    public function forceDelete($id)
    {
        $course = Course::onlyTrashed()->findOrFail($id);
        $course->forceDelete();
        $course->image()->delete();
        return redirect()->route('courses.index')->with('message', 'Course Permenantly Deleted Successfully');
    }
}
