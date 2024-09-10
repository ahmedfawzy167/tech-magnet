<?php

namespace App\Http\Controllers\Admin;

use App\Models\Payment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::with('user', 'course')->where('status', 'inactive')->get();
        return view('payments.index', compact('payments'));
    }

    public function update($id)
    {
        $payment = Payment::findOrFail($id);
        $payment->status = 'active';
        $payment->save();
        return redirect()->route('payments.index')->with('message', 'Payment Status Updated Successfully');
    }
}
