<?php

namespace App\Http\Controllers\Admin;

use App\Models\Image;
use App\Models\Course;
use App\Models\Category;
use App\Models\Objective;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

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
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|between:2,100',
            'description' => 'required|string|max:1000',
            'price' => ['required', 'regex:/^\d+(\.\d{1,2})?$/', 'gt:0'],
            'hours' => 'required|numeric:gt:0',
            'category_id' => 'required|numeric:gt:0',
            'objective_id' => 'required|numeric:gt:0',
            'image'       => 'required|image|mimes:jpeg,png,jpg|max:3000'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

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

        $image = new Image();
        $image->path = $fileName;
        $image->imageable_id = $course->id;
        $image->imageable_type = 'App\Models\Course';
        $image->save();

        Session::flash('message', 'Course is Created Successfully');
        return redirect(route('courses.index'));
    }


    public function edit(Course $course)
    {
        $categories = Category::all();
        $objectives = Objective::all();
        return view('courses.edit', get_defined_vars());
    }

    public function update(Request $request, Course $course)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|between:2,100',
            'description' => 'required|string|max:1000',
            'price' => ['required', 'regex:/^\d+(\.\d{1,2})?$/', 'gt:0'],
            'hours' => 'required|numeric:gt:0',
            'category_id' => 'required|numeric:gt:0',
            'objective_id' => 'required|numeric:gt:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:3000'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $course->name = $request->name;
        $course->description = $request->description;
        $course->price = $request->price;
        $course->hours = $request->hours;
        $course->category_id = $request->category_id;
        $course->objective_id = $request->objective_id;
        $course->update();

        if ($request->hasFile('image')) {
            $img = $request->file('image');
            $ext = $img->getClientOriginalExtension();
            $fileName = Date("Y-m-d-h-i-s") . '.' . $ext;
            $location = "public/";
            $img->storeAs($location, $fileName);

            $image = $course->image;
            if ($image) {
                $image->path = $fileName;
                $image->save();
            } else {
                $image = new Image();
                $image->path = $fileName;
                $image->imageable_id = $course->id;
                $image->imageable_type = 'App\Models\Course';
                $image->save();
            }
        }

        Session::flash('message', 'Course is Updated Successfully');
        return redirect(route('courses.index'));
    }




    public function destroy(Course $course)
    {
        $course->delete();
        Session::flash('message', 'course is Deleted Successfully');
        return redirect(route('courses.index'));
    }
}
