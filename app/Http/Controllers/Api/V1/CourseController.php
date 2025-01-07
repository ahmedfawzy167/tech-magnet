<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Course;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CourseResource;
use App\Http\Resources\CourseCollection;
use App\Traits\ApiResponder;

class CourseController extends Controller
{
    use ApiResponder;

    public function index(Request $request)
    {
        $sortBy = $request->get('sort_by', 'created_at');
        $sortOrder = $request->get('sort_order', 'desc');

        $courses = Course::with(['image', 'category'])
            ->where('status', 1)
            ->orderBy($sortBy, $sortOrder)
            ->paginate(4);

        return $this->success(new CourseCollection($courses));
    }

    public function show($id)
    {
        $course = Course::find($id);

        if (!$course) {
            return $this->notFound("Course Not Found");
        }

        $relatedCourses = Course::where('category_id', $course->category_id)
            ->where('id', '!=', $course->id)
            ->get();

        return $this->success([
            'course' => new CourseResource($course),
            'relatedCourses' => CourseResource::collection($relatedCourses)
        ]);
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        $course = Course::with(['image', 'category'])->where('name', 'like', '%' . $query  . '%')->get();

        return response()->json($course);
    }

    public function filter(Request $request)
    {
        $courses = Course::query();

        $categoryId = $request->input('category_id');
        $priceMin = $request->input('price_min', null);
        $priceMax = $request->input('price_max', null);

        if ($categoryId) {
            $courses->where('category_id', $categoryId);
        } elseif ($priceMin !== null) {
            $courses->where('price', '>=', $priceMin);
        } elseif ($priceMax !== null) {
            $courses->where('price', '<=', $priceMax);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'No Courses Available!',
            ], 404);
        }

        $courses = $courses->with(['image', 'category'])
            ->get();

        return response()->json($courses);
    }
}
