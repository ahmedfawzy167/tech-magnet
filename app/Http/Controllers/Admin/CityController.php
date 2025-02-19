<?php

namespace App\Http\Controllers\Admin;

use App\Models\City;
use App\Models\Country;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCityRequest;
use App\Http\Requests\UpdateCityRequest;

class CityController extends Controller
{
    public function index()
    {
        $cities = City::with('country')->get();
        $countries = Country::all();
        return view('cities.index', compact('cities','countries'));
    }

    public function show(City $city)
    {
       $city->load('country');
        return view('cities.show', compact('city'));
    }

    public function store(StoreCityRequest $request, City $city)
    {
        $city::create($request->validated());

        return redirect(route('cities.index'))->with('message', 'City Created Successfully');
    }

    public function update(UpdateCityRequest $request, City $city)
    {
        $city->update($request->validated());
        return redirect(route('cities.index'))->with('message', 'City Updated Successfully');
    }

    public function destroy(City $city)
    {
        $city->delete();
        return redirect(route('cities.index'))->with('message', 'City Deleted Successfully');
    }

    public function trash()
    {
        $trashedCities = City::onlyTrashed()->get();
        return view('cities.trashed', compact('trashedCities'));
    }

    public function restore($id)
    {
        $city = City::withTrashed()->findOrFail($id);
        $city->restore();
        return redirect()->back()->with('message', 'City Restored Successfully');
    }

    public function forceDelete($id)
    {
        $city = City::withTrashed()->findOrFail($id);
        $city->forceDelete();
        return redirect()->back()->with('message', 'City Permenantly Deleted Successfully');
    }
}
