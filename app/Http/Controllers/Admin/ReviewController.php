<?php

namespace App\Http\Controllers\Admin;

use App\Models\Review;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class ReviewController extends Controller
{
    public function index()
    {
        $reviews = Review::with('user', 'course')->get();
        return view('reviews.index', compact('reviews'));
    }

    public function destroy(Review $review)
    {
        $review->delete();
        Session::flash('message', 'Review Deleted Successfully');
        return redirect(route('reviews.index'));
    }
}
