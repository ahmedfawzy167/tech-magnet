<?php

namespace App\Http\Controllers\Api;

use App\Models\Cart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CartResource;
use App\Traits\ApiResponder;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    use ApiResponder;

    public function index()
    {
        $carts = Cart::where('user_id', auth()->user()->id)->with('course')->get();
        return $this->success(CartResource::collection($carts));
    }

    public function totalCartItems()
    {
        $cartItems = Cart::where('user_id', auth()->user()->id)->with('course')->count();
        return $this->success($cartItems);
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
            return $this->conflict("Course Already in Your Cart!");
        }

        $cart = Cart::create([
            'user_id' => $userId,
            'course_id' => $request->course_id,
        ]);

        $cartItems = Cart::where('user_id', $userId)
            ->where('course_id', $request->course_id)
            ->get();

        return $this->created(CartResource::collection($cartItems), "Course Added to Cart Successfully");
    }


    public function destroy($courseId, Request $request)
    {
        $userId = Auth::id();

        $cart = Cart::where('user_id', $userId)
            ->where('course_id', $courseId)
            ->first();

        if (!$cart) {
            return $this->notFound("Course Not Found");
        }

        $cart->delete();

        $cartItems = Cart::where('user_id', $userId)->get();

        return $this->success(CartResource::collection($cartItems), 'Course Removed From Your Cart Successfully');
    }
}
