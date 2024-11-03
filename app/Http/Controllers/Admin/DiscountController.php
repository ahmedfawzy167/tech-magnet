<?php

namespace App\Http\Controllers\Admin;

use App\Models\{Discount, Course};
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDiscountRequest;
use App\Http\Requests\UpdateDiscountRequest;

class DiscountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $discounts = Discount::with('courses')->get();
        return view('discounts.index', compact('discounts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $courses = Course::all();
        return view('discounts.create', compact('courses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDiscountRequest $request)
    {
        DB::beginTransaction();
        try {
            $discount = new Discount();
            $discount->code = $request->code;
            $discount->amount = $request->amount;
            $discount->percentage = $request->percentage;
            $discount->expiry_date = $request->expiry_date;
            $discount->save();

            $discount->courses()->attach($request->courses, []);
            DB::commit();
            return redirect()->route('discounts.index')->with('message', 'Discount Created Successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['errors' => 'Error Creating Discount: ' . $e->getMessage()]);
        }
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $discount = Discount::with('courses')->findOrFail($id);
        $courses = Course::all();
        return view('discounts.edit', compact('discount', 'courses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDiscountRequest $request, Discount $discount)
    {
        DB::beginTransaction();
        try {
            $discount->update($request->validated());
            $discount->courses()->sync($request->courses, []);
            DB::commit();
            return to_route('discounts.index')->with('message', 'Discount Updated Successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['errors' => 'Error Updating Discount: ' . $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Discount $discount)
    {
        $discount->courses()->detach();
        $discount->delete();

        return to_route('discounts.index')->with('message', 'Discount Deleted Successfully');
    }
}
