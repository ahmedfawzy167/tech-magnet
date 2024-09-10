<?php

namespace App\Http\Controllers\Admin;

use App\Models\City;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCityRequest;
use App\Http\Requests\UpdateCityRequest;

class CityController extends Controller
{
    public function index()
    {
        $cities = City::all();
        Log::info("Cities Logged Successfully!");
        return view('cities.index', compact('cities'));
    }

    public function show(City $city)
    {
        $users = $city->users;
        return view('cities.show', compact('city', 'users'));
    }

    public function create()
    {
        return view('cities.create');
    }

    public function store(StoreCityRequest $request, City $city)
    {
        $city::create($request->validated());

        return redirect(route('cities.index'))->with('message', 'City Updated Successfully');
    }


    public function edit(City $city)
    {
        return view('cities.edit', compact('city'));
    }

    public function update(UpdateCityRequest $request, City $city)
    {
        $request->validated();
        $city->name = $request->name;
        $city->save();

        return redirect(route('cities.index'))->with('message', 'City Updated Successfully');
    }

    public function destroy(City $city)
    {
        $city->delete();
        return redirect(route('cities.index'))->with('message', 'City Trashed Successfully');
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
        return redirect()->route('cities.index')->with('message', 'City Restored Successfully');
    }

    public function forceDelete($id)
    {
        $city = City::withTrashed()->findOrFail($id);
        $city->forceDelete();
        return redirect()->route('cities.index')->with('message', 'City Permenantly Deleted Successfully');
    }
}
