<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
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
        return view('profile.edit', compact('admin'));
    }

    public function update(UpdateAdminProfileRequest $request, $id)
    {
        $admin = Admin::findOrFail($id);
        $admin->name = $request->name;
        $admin->email = $request->email;

        // Update Password if New Password is Provided
        if ($request->new_password) {
            $admin->password = bcrypt($request->new_password);
        }
        $admin->save();
        $this->uploadImages($request,$admin);

        return redirect()->route('profile.edit')->with('message', 'Credentials Updated Successfully');
    }
}
