<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAddressRequest;
use App\Http\Requests\UpdateAddressRequest;
use App\Models\Address;
use App\Models\City;
use App\Models\User;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $addresses = Address::with(['user', 'city'])->get();
        return view('addresses.index', compact('addresses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        $cities = City::all();
        return view('addresses.create', get_defined_vars());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAddressRequest $request)
    {
        $address = new Address();
        $address->address = $request->address;
        $address->user_id = $request->user_id;
        $address->city_id = $request->city_id;
        $address->save();

        return redirect(route('addresses.index'))->with('message', 'Address Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Address $address)
    {
        return view('addresses.show', compact('address'));
    }
    /**
     * Show the form for editing the specified resource.
     */

    public function edit(Address $address)
    {
        $users = User::all();
        $cities = City::all();
        return view('addresses.edit', get_defined_vars());
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(UpdateAddressRequest $request, Address $address)
    {
        $address->address = $request->address;
        $address->user_id = $request->user_id;
        $address->city_id = $request->city_id;
        $address->save();

        return redirect(route('addresses.index'))->with('message', 'Address Updated Sucessfully');
    }

    public function destroy(Address $address)
    {
        $address->delete();
        return redirect(route('addresses.index'))->with('message', 'Address Deleted Successfully');
    }
}
