<?php

namespace App\Http\Controllers\Admin;

use App\Models\{Course, Category, Objective, Roadmap};
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCourseRequest;
use App\Http\Requests\UpdateCourseRequest;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::with(['category', 'image', 'objective'])->get();
        return view('courses.index', compact('courses'));
    }

    public function create()
    {
        $categories = Category::all();
        $objectives = Objective::all();
        $roadmaps = Roadmap::all();
        return view('courses.create', get_defined_vars());
    }

    public function store(StoreCourseRequest $request)
    {
        $request->validated();

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

        $course->roadmaps()->attach($request->input('roadmaps', []));

        return redirect(route('courses.index'))->with('message', 'Course Created Successfully');
    }

    public function show(Course $course)
    {
        $course->load(['category', 'objective', 'image', 'roadmaps']);
        return view('courses.show', compact('course'));
    }


    public function edit(Course $course)
    {
        $categories = Category::all();
        $objectives = Objective::all();
        $roadmaps = Roadmap::all();
        return view('courses.edit', get_defined_vars());
    }

    public function update(UpdateCourseRequest $request, Course $course)
    {
        $request->validated();

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

        $course->roadmaps()->sync($request->input('roadmaps', []));

        return redirect(route('courses.index'))->with('message', 'Course Updated Sucessfully');
    }

    public function destroy(Course $course)
    {
        $course->delete();
        return redirect(route('courses.index'))->with('message', 'Course Trashed Sucessfully');
    }

    public function trash()
    {
        $trashedCourses = Course::onlyTrashed()->get();
        return view('courses.trashed', compact('trashedCourses'));
    }

    public function restore($id)
    {
        $course = Course::withTrashed()->findOrFail($id);
        $course->restore();
        return redirect()->route('courses.index')->with('message', 'Course Restored Successfully');
    }

    public function forceDelete($id)
    {
        $course = Course::withTrashed()->findOrFail($id);
        $course->forceDelete();
        $course->image()->delete();
        return redirect()->route('courses.index')->with('message', 'Course Permenantly Deleted Successfully');
    }
}
