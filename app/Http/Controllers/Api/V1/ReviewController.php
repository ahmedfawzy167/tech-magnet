<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Review;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreReviewRequest;
use App\Traits\ApiResponder;
use Illuminate\Support\Facades\Validator;

class ReviewController extends Controller
{
   use ApiResponder;

    public function store(StoreReviewRequest $request)
    {
        if (!auth()->user()->hasRole('Student')) {
            return $this->forbidden('Access Forbidden');
        }
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
        if (!auth()->user()->hasRole('Student')) {
            return $this->forbidden('Access Forbidden');
        }
        $review->delete();
        return $this->success($review, "Review Deleted Successfully");
    }
}
