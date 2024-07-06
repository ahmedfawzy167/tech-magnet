<?php

namespace App\Http\Controllers\Admin;

use App\Models\Setting;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

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
        $validator = Validator::make($request->all(), [
            'logo' => 'required|image|mimes:png,jpg,jpeg|max:2048',
            'email' => 'required|email|unique:settings',
            'phone' => 'required|string',
            'location' => 'required|string|max:50',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

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

        Session::flash('message', 'Setting is Created Successfully');
        return redirect(route('settings.index'));
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
        $validator = Validator::make($request->all(), [
            'logo' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
            'email' => 'required|email',
            'phone' => 'required|string',
            'location' => 'required|string|max:50',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');
            $ext = $logo->getClientOriginalExtension();
            $location = "/public";
            $fileName = Date("Y-m-d-h-i-s") . '.' . $ext;
            $logo->storeAs($location, $fileName);
        }

        $setting->logo = $fileName;
        $setting->email = $request->email;
        $setting->phone = $request->phone;
        $setting->location = $request->location;
        $setting->save();

        Session::flash('message', 'Setting is Updated Successfully');
        return redirect(route('settings.index'))->withInput();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Setting $setting)
    {
        $setting->delete();
        Session::flash('message', 'Setting is Deleted Now!');
        return redirect(route('settings.index'));
    }
}
