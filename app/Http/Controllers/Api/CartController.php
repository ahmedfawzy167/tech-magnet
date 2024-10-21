<?php

namespace App\Http\Controllers\Api;

use App\Models\Cart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CartResource;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $carts = Cart::where('user_id', auth()->user()->id)->with('course')->get();
        return CartResource::collection($carts);
    }

    public function totalCartItems()
    {
        $cartItems = Cart::where('user_id', auth()->user()->id)->with('course')->count();
        return response()->json([
            'totalCartItems' => $cartItems
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
        ]);

        $userId = Auth::id();

        // Check if the course is already in the cart
        $cart = Cart::where('user_id', $userId)
            ->where('course_id', $request->course_id)
            ->first();

        if ($cart) {
            return response()->json(['message' => 'Course Already in Your Cart!'], 409);
        }

        $cart = Cart::create([
            'user_id' => $userId,
            'course_id' => $request->course_id,
        ]);

        return response()->json([
            'message' => 'Course Added to Cart Successfully',
        ], 201);
    }


    public function destroy($courseId)
    {
        $userId = Auth::id();

        $cartItem = Cart::where('user_id', $userId)
            ->where('course_id', $courseId)
            ->first();

        if (!$cartItem) {
            return response()->json(['message' => 'Course Not Found in Cart!'], 404);
        }

        $cartItem->delete();

        return response()->json(['message' => 'Course Removed From Cart Successfully'], 200);
    }
}
