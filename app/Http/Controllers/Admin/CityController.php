<?php

namespace App\Http\Controllers\Admin;

use App\Models\City;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\UpdateCityRequest;

class CityController extends Controller
{
    public function index()
    {
        $cities = City::all();
        return view('cities.index', compact('cities'));
    }

    public function show(City $city)
    {
        $users = $city->users;
        return view('cities.show', compact('city', 'users'));
    }

    public function edit(City $city)
    {
        return view('cities.edit', compact('city'));
    }

    public function update(UpdateCityRequest $request, City $city)
    {
        $request->validated();
        $city->name = $request->name;
        $city->update();

        Session::flash('message','City is Updated Successfully!');
        return redirect(route('cities.index'));
    }

    public function destroy(City $city)
    {
        $city->delete();
        Session::flash('message','City is Deleted Successfully');
        return redirect(route('cities.index'));
    }
}
