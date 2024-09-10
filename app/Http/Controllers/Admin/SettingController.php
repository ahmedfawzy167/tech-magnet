<?php

namespace App\Http\Controllers\Admin;

use App\Models\Setting;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
    public function store(Request $request)
    {
        $request->validate([
            'logo' => 'required|image|mimes:png,jpg,jpeg|max:2048',
            'email' => 'required|email|unique:settings',
            'phone' => 'required|string',
            'location' => 'required|string|max:50',
        ]);


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
    public function update(Request $request, Setting $setting)
    {
        $request->validate([
            'logo' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
            'email' => 'required|email',
            'phone' => 'required|string',
            'location' => 'required|string|max:50',
        ]);


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
        $setting->delete();
        return redirect(route('settings.index'))->with('message', 'Setting Deleted Successfully');
    }
}
