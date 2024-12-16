<?php

namespace App\Http\Controllers\Api\V1;

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
        $request->validate([
            'course_id' => 'required|numeric|gt:0',
            'user_id' => 'required|numeric|gt:0',
            'content' =>  'required|string|max:500',
            'rating' => 'required|numeric|gt:0',
        ]);

        $review = new Review();
        $review->course_id = $request->course_id;
        $review->user_id = $request->user_id;
        $review->content = $request->content;
        $review->rating = $request->rating;
        $review->save();

        return $this->created($review, "Review Created Successfully");
    }

    public function destroy(Review $review)
    {
        $review->delete();
        return $this->success($review, "Review Deleted Successfully");
    }
}
