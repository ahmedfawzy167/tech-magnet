<?php

namespace App\Http\Controllers\Api;

use App\Models\Course;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CourseResource;
use App\Http\Resources\CourseCollection;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::with(['image', 'category', 'objective'])->paginate(4);
        return new CourseCollection($courses);
    }

    public function show($id)
    {
        $course = Course::with(['roadmaps', 'image'])->find($id);
        if ($course != null) {
            return new CourseResource($course);
        } else {
            return response()->json([
                "message" => "Course Not Found"
            ], 404);
        }
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        $course = Course::with(['image', 'category', 'objective'])->where('name', 'like', '%' . $query  . '%')->get();

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

        $courses = $courses->with(['image', 'category', 'objective'])
            ->get();

        return response()->json($courses);
    }
}
