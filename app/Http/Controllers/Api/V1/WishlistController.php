<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Wishlist;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreWishlistRequest;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\WishlistResource;
use App\Traits\ApiResponder;

class WishlistController extends Controller
{
    use ApiResponder;

    public function index()
    {
        if (!auth()->user()->hasRole('Student')) {
            return $this->forbidden('Access Forbidden');
        }
        $wishlists = Wishlist::where('user_id', auth()->user()->id)->with('course')->get();
        return $this->success(WishlistResource::collection($wishlists));
    }

    public function totalWishlistItems()
    {
        if (!auth()->user()->hasRole('Student')) {
            return $this->forbidden('Access Forbidden');
        }
        $wishlistItems = Wishlist::where('user_id', auth()->user()->id)->with('course')->count();
        return $this->success($wishlistItems);
    }


    public function store(StoreWishlistRequest $request)
    {
        if (!auth()->user()->hasRole('Student')) {
            return $this->forbidden('Access Forbidden');
        }
    
        $userId = Auth::id();

        // Check if the course is already in the wishlist
        $wishlist = Wishlist::where('user_id', $userId)
            ->where('course_id', $request->course_id)
            ->first();

        if ($wishlist) {
            return $this->conflict("Course Already in Your Wishlist!");
        }

        $wishlist = Wishlist::create([
            'user_id' => $userId,
            'course_id' => $request->course_id,
        ]);

        $wishlistItems = Wishlist::where('user_id', $userId)
            ->where('course_id', $request->course_id)
            ->get();

        return $this->created(WishlistResource::collection($wishlistItems), "Course Added to Wishlist Successfully");
    }


    public function destroy($courseId)
    {
        if (!auth()->user()->hasRole('Student')) {
            return $this->forbidden('Access Forbidden');
        }
        $userId = Auth::id();

        $wishlist = Wishlist::where('user_id', $userId)
            ->where('course_id', $courseId)
            ->first();

        if (!$wishlist) {
            return $this->notFound('Course Not Found');
        }

        $wishlist->delete();

        $wishlistItems = Wishlist::where('user_id', $userId)->get();

        return $this->success(WishlistResource::collection($wishlistItems), 'Course Removed From Wishlist Successfully');
    }
}
