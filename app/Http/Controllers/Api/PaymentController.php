<?php

namespace App\Http\Controllers\Api;

use Stripe\StripeClient;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePaymentRequest;
use App\Http\Resources\PaymentResource;
use App\Models\Payment;
use App\Traits\ApiResponder;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    use ApiResponder;

    public $stripe;

    public function __construct()
    {
        $this->stripe = new StripeClient(
            config('stripe.api_key.secret')
        );
    }

    public function pay(Request $request)
    {
        $coupon = $this->stripe->coupons->create([
            'duration' => 'repeating',
            'duration_in_months' => 3,
            'percent_off' => 20,
        ])->id;

        $cu = $this->stripe->promotionCodes->create([
            'coupon' => $coupon,
            'code' => 'Fs2ghs',
        ])->id;

        $session = $this->stripe->checkout->sessions->create([
            'shipping_options' => [
                [
                    'shipping_rate_data' => [
                        'type' => 'fixed_amount',
                        'fixed_amount' => [
                            'amount' => 1500,
                            'currency' => 'usd',
                        ],
                        'display_name' => 'Next Day air',
                        'delivery_estimate' => [
                            'minimum' => [
                                'unit' => 'business_day',
                                'value' => 1,
                            ],
                            'maximum' => [
                                'unit' => 'business_day',
                                'value' => 7,
                            ],
                        ],
                    ],
                ],
            ],
            'mode' => 'payment',
            'success_url' => 'https://example.com/success',
            'line_items' => [
                [
                    'price_data' => [
                        'currency' => 'usd',
                        'product_data' => [
                            'name' => $request->course_name,
                            'images' => ['https://www.google.com/url?sa=i&url=https%3A%2F%2Fstock.adobe.com%2Fsearch%3Fk%3Dbackend&psig=AOvVaw0nby8zOXc4Z5FAySNw6xtC&ust=1719672340034000&source=images&cd=vfe&opi=89978449&ved=0CBEQjRxqFwoTCKDwrezE_oYDFQAAAAAdAAAAABAE'],
                        ],
                        'unit_amount' => $request->price,
                    ],
                    'quantity' => 1,
                ],
            ],
            'allow_promotion_codes' => true,
        ]);
        return response()->json([
            'stripe_url' => $session->url
        ], 302);
    }

    public function store(StorePaymentRequest $request)
    {
        $payment =  new Payment();
        $payment->user_id = auth()->user()->id;
        $payment->course_id = $request->course_id;
        $payment->amount = $request->amount;
        $payment->currency = $request->currency;
        $payment->save();
        return $this->created(new PaymentResource($payment), 'Payment Created Successfully');
    }
}
