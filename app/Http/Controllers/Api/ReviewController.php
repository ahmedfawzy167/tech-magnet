<?php

namespace App\Http\Controllers\Api;

use App\Models\Review;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ReviewController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Review::class);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'course_id' => 'required|numeric|gt:0',
            'user_id' => 'required|numeric|gt:0',
            'content' =>  'required|string|max:500',
            'rating' => 'required|numeric|gt:0',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $review = new Review();
        $review->course_id = $request->course_id;
        $review->user_id = $request->user_id;
        $review->content = $request->content;
        $review->rating = $request->rating;
        $review->save();

        return response()->json([
            'status' => 'Success',
            'message' => 'Review Added Successfully',
        ], 201);
    }

    public function destroy(Review $review)
    {
        $review->delete();
        return response()->json([
            'status' => 'Success',
            'message' => 'Review Deleted Successfully'
        ], 204);
    }
}
