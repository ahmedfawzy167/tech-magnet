<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ProfileController extends Controller
{
    public function show()
    {
        $admin = Auth::guard('admin')->user();
        return view('profile.show',compact('admin'));
    }
    public function edit()
    {
        $admin = Auth::guard('admin')->user();
        return view('profile.edit',compact('admin'));
    }
    public function update(Request $request,$id)
    {
        $request->validate([
            'email' => 'required|string|max:100',
            'current_password' => 'required|current_password',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        $admin = Admin::findOrFail($id);
        $admin->email = $request->email;
        $admin->password = bcrypt($request->new_password);
        $admin->save();

        Session::flash('message','Credentials Updated Successfully');
        return redirect()->route('profile.edit');
    }
}
