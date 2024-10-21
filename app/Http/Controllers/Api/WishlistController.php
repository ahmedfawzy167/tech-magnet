<?php

namespace App\Http\Controllers\Api;

use App\Models\Wishlist;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\WishlistResource;

class WishlistController extends Controller
{
    public function index()
    {
        $wishlists = Wishlist::where('user_id', auth()->user()->id)->with('course')->get();
        return WishlistResource::collection($wishlists);
    }

    public function totalWishlistItems()
    {
        $wishlistItems = Wishlist::where('user_id', auth()->user()->id)->with('course')->count();
        return response()->json([
            'totalwishlistItems' => $wishlistItems
        ]);
    }


    public function store(Request $request)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
        ]);

        $userId = Auth::id();

        // Check if the course is already in the wishlist
        $wishlist = Wishlist::where('user_id', $userId)
            ->where('course_id', $request->course_id)
            ->first();

        if ($wishlist) {
            return response()->json(['message' => 'Course Already in Your Wishlist!'], 409);
        }

        $wishlist = Wishlist::create([
            'user_id' => $userId,
            'course_id' => $request->course_id,
        ]);

        return response()->json([
            'message' => 'Course Added to Wishlist Successfully',
        ], 201);
    }


    public function destroy($courseId)
    {
        $userId = Auth::id();

        $wishlistItem = Wishlist::where('user_id', $userId)
            ->where('course_id', $courseId)
            ->first();

        if (!$wishlistItem) {
            return response()->json(['message' => 'Course Not Found in Wishlist!'], 404);
        }

        $wishlistItem->delete();

        return response()->json(['message' => 'Course Removed From Wishlist Successfully'], 200);
    }
}
