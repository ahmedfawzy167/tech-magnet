<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreCourseRequest;
use App\Http\Requests\UpdateCourseRequest;
use App\Models\{Course, Category, Roadmap};

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::with(['category', 'image'])->get();
        $averagePrice = $courses->averageOf('price');
        return view('courses.index', compact('courses', 'averagePrice'));
    }

    public function create()
    {
        $categories = Category::all();
        $roadmaps = Roadmap::all();
        return view('courses.create', get_defined_vars());
    }

    public function store(StoreCourseRequest $request)
    {
        DB::beginTransaction();

        try {
            $course = new Course();
            $course->name = $request->name;
            $course->description = $request->description;
            $course->price = $request->price;
            $course->hours = $request->hours;
            $course->category_id = $request->category_id;
            $course->status = $request->has('status') ? 1 : 0;
            $course->save();
            $course->roadmaps()->attach($request->roadmaps);

            if ($request->hasFile('image')) {
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
            }

            DB::commit();
            return redirect(route('courses.index'))->with('message', 'Course Created Successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors('error', $e->getMessage());
        }
    }

    public function show(Course $course)
    {
        $course->load(['category', 'image', 'roadmaps', 'discounts']);
        $price = $course->price;
        $discountAmount = 0;

        foreach ($course->discounts as $discount) {
            if ($discount->is_active && $discount->expiry_date > now()) {
                if ($discount->percentage) {
                    $discountAmount += $price * ($discount->percentage / 100);
                } elseif ($discount->amount) {
                    $discountAmount += $discount->amount;
                }
            }
        }

        $finalPrice = max($price - $discountAmount, 0);
        return view('courses.show', compact('course', 'finalPrice'));
    }


    public function edit(Course $course)
    {
        $categories = Category::all();
        $roadmaps = Roadmap::all();
        return view('courses.edit', get_defined_vars());
    }

    public function update(UpdateCourseRequest $request, Course $course)
    {
        DB::beginTransaction();
        try {
            $course->name = $request->name;
            $course->description = $request->description;
            $course->price = $request->price;
            $course->hours = $request->hours;
            $course->category_id = $request->category_id;
            $course->status = $request->has('status') ? 1 : 0;
            $course->save();
            $course->roadmaps()->sync($request->roadmaps);

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

            DB::commit();
            return redirect(route('courses.index'))->with('message', 'Course Updated Sucessfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors('error', $e->getMessage());
        }
    }

    public function destroy(Course $course)
    {
        $course->delete();
        return redirect(route('courses.index'))->with('message', 'Course Deleted Sucessfully');
    }

    public function trash()
    {
        $trashedCourses = Course::with(['image', 'category'])->onlyTrashed()->get();
        return view('courses.trashed', compact('trashedCourses'));
    }

    public function restore($id)
    {
        $course = Course::withTrashed()->findOrFail($id);
        $course->restore();
        return redirect()->back()->with('message', 'Course Restored Successfully');
    }

    public function forceDelete($id)
    {
        $course = Course::withTrashed()->findOrFail($id);

        // Check if the Course has any Associated Roadmaps
        if ($course->roadmaps()->exists()) {
            return redirect()->back()->withErrors([
                'error' => 'Cannot Delete Course while it has Associated Roadmaps.'
            ]);
        }

        // Check if Course has image
        if ($course->image()->exists()) {
            Storage::disk('public')->delete($course->image->path);
        }

        $course->roadmaps()->detach();
        $course->image()->delete();
        $course->forceDelete();
        return redirect()->back()->with('message', 'Course Permenantly Deleted Successfully');
    }

    public function bulkDestroy(Request $request)
    {
        $ids = $request->input('ids')[0];

        if (empty($ids)) {
            return redirect()->back()->withErrors(['error' => 'No Courses Selected!']);
        }

        $ids = explode(',', $ids);
        Course::whereIn('id', $ids)->delete();
        return redirect()->back()->with('message', 'Courses Deleted Successfully');
    }

    public function bulkActivate(Request $request)
    {
        $ids = $request->input('ids')[0];

        if (empty($ids)) {
            return redirect()->back()->withErrors(['error' => 'No Courses Selected!']);
        }

        $ids = explode(',', $ids);

        Course::whereIn('id', $ids)->update(['status' => true]);
        return redirect()->back()->with('message', 'Courses Activated Successfully');
    }

    public function bulkDeactivate(Request $request)
    {
        $ids = $request->input('ids')[0];

        if (empty($ids)) {
            return redirect()->back()->withErrors(['error' => 'No Courses Selected!']);
        }

        $ids = explode(',', $ids);

        Course::whereIn('id', $ids)->update(['status' => false]);
        return redirect()->back()->with('message', 'Courses Deactivated Successfully');
    }
}
