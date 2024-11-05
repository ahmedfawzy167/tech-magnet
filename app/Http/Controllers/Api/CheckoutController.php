<?php

namespace App\Http\Controllers\Api;

use App\Models\Cart;
use App\Traits\ApiResponder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CartResource;

class CheckoutController extends Controller
{
    use ApiResponder;

    public function checkout()
    {
        try {
            $cartItems = Cart::where('user_id', auth()->user()->id)->get();
            if ($cartItems->isEmpty()) {
                return $this->error('Your Cart is Empty! Start Shopping Now.');
            }
            return $this->success(CartResource::collection($cartItems));
        } catch (\Exception $e) {
            return $this->serverError('An Error Occurred While Displaying Checkout Details!');
        }
    }
}
