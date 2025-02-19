<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Cart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\DecreaseQuantityRequest;
use App\Http\Requests\IncreaseQuantityRequest;
use App\Http\Requests\StoreCartRequest;
use App\Http\Resources\CartResource;
use App\Traits\ApiResponder;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    use ApiResponder;

    public function index()
    {
        if (!auth()->user()->hasRole('Student')) {
            return $this->forbidden('Access Forbidden');
        }
        $carts = Cart::where('user_id', auth()->user()->id)->with('course')->get();
        return $this->success(CartResource::collection($carts));
    }

    public function totalCartItems()
    {
        if (!auth()->user()->hasRole('Student')) {
            return $this->forbidden('Access Forbidden');
        }
        $cartItems = Cart::where('user_id', auth()->user()->id)->with('course')->count();
        return $this->success($cartItems);
    }

    public function store(StoreCartRequest $request)
    {
        if (!auth()->user()->hasRole('Student')) {
            return $this->forbidden('Access Forbidden');
        }
        $this->authorize('create', Cart::class);
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
            'quantity' => $request->quantity,
        ]);

        $cartItems = Cart::where('user_id', $userId)
            ->where('course_id', $request->course_id)
            ->get();

        return $this->created(CartResource::collection($cartItems), "Course Added to Cart Successfully");
    }


    public function destroy($courseId)
    {

        if (!auth()->user()->hasRole('Student')) {
            return $this->forbidden('Access Forbidden');
        }

        $userId = Auth::id();

        $cart = Cart::where('user_id', $userId)
            ->where('course_id', $courseId)
            ->first();

        if (!$cart) {
            return $this->notFound("Course Not Found");
        }

        $this->authorize('delete', $cart);

        $cart->delete();

        $cartItems = Cart::where('user_id', $userId)->get();

        return $this->success(CartResource::collection($cartItems), 'Course Removed From Your Cart Successfully');
    }


    public function increaseQuantity(IncreaseQuantityRequest $request)
    {
        if (!auth()->user()->hasRole('Student')) {
            return $this->forbidden('Access Forbidden');
        }

        $userId = Auth::id();

        $cart = Cart::where('user_id', $userId)
            ->where('course_id', $request->course)
            ->first();

        if (!$cart) {
            return $this->notFound("Course Not Found in Cart");
        }

        // Increase the Quantity
        $cart->quantity += $request->quantity;
        $cart->save();

        return $this->success(new CartResource($cart), 'Quantity Increased Successfully');
    }


    public function decreaseQuantity(DecreaseQuantityRequest $request)
    {
        if (!auth()->user()->hasRole('Student')) {
            return $this->forbidden('Access Forbidden');
        }

        $userId = Auth::id();

        $cart = Cart::where('user_id', $userId)
            ->where('course_id', $request->course)
            ->first();

        if (!$cart) {
            return $this->notFound("Course Not Found in Cart");
        }

        // Decrease the quantity
        if ($cart->quantity <= $request->quantity) {
            $cart->delete();
            return $this->success($cart, 'Course Removed from Cart Successfully');
        } else {
            $cart->quantity -= $request->quantity;
            $cart->save();
        }

        return $this->success(new CartResource($cart), 'Quantity Decreased Successfully');
    }
}
