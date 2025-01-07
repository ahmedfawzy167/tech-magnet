<?php

namespace App\Http\Controllers\Admin;

use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreSettingRequest;
use App\Http\Requests\UpdateSettingRequest;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::all();
        return view('settings.index', compact('settings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('settings.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSettingRequest $request)
    {
        if ($request->hasFile('logo')) {

            $logo = $request->file('logo');
            $ext = $logo->getClientOriginalExtension();
            $location = "/public";
            $fileName = Date("Y-m-d-h-i-s") . '.' . $ext;
            $logo->storeAs($location, $fileName);

            $setting = new Setting();
            $setting->logo = $fileName;
            $setting->email = $request->email;
            $setting->phone = $request->phone;
            $setting->location = $request->location;
            $setting->save();
        }
        return redirect(route('settings.index'))->with('message', 'Setting Created Successfully');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Setting $setting)
    {
        return view('settings.edit', compact('setting'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSettingRequest $request, Setting $setting)
    {
        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');
            $ext = $logo->getClientOriginalExtension();
            $location = "/public";
            $fileName = Date("Y-m-d-h-i-s") . '.' . $ext;
            $logo->storeAs($location, $fileName);
            $setting->logo = $fileName;
            $setting->email = $request->email;
            $setting->phone = $request->phone;
            $setting->location = $request->location;
            $setting->update();
        }

        return redirect(route('settings.index'))->with('message', 'Setting Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Setting $setting)
    {
        // Check if Setting has Logo
        if ($setting->logo) {
            Storage::disk('public')->delete($setting->logo);
        }
        $setting->delete();
        return redirect(route('settings.index'))->with('message', 'Setting Deleted Successfully');
    }
}
