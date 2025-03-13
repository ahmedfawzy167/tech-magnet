<?php

namespace App\Http\Controllers\Admin;

use App\Models\City;
use App\Models\Admin;
use App\Models\Country;
use App\Traits\FileUpload;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UpdateAdminProfileRequest;

class ProfileController extends Controller
{
    use FileUpload;

    public function show()
    {
        $admin = Auth::guard('admin')->user();
        return view('profile.show', compact('admin'));
    }

    public function edit()
    {
        $admin = Auth::guard('admin')->user();
        $countries = Country::all();
        $cities = City::all();
        
        return view('profile.edit', compact('admin', 'countries', 'cities'));
    }

    public function update(UpdateAdminProfileRequest $request, $id)
    {
        $admin = Admin::findOrFail($id);
        $admin->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'city_id' => $request->city_id,
            'country_id' => $request->country_id,
            'address' => $request->address,
            'timezone' => $request->timezone,
        ]);

         // Update Password if New Password is Provided
        if ($request->new_password) {
           $admin->update(['password' => bcrypt($request->new_password)]);
        }
        $this->uploadImages($request,$admin);

        return redirect()->route('profile.edit')->with('message', 'Credentials Updated Successfully');
    }
}
