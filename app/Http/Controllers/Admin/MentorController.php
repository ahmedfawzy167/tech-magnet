<?php

namespace App\Http\Controllers\Admin;

use App\Models\{City, Role, User};
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;

class MentorController extends Controller
{
    public function index()
    {
        $mentors = User::with('city')->where('role_id', 5)->get();
        return view('mentors.index', compact('mentors'));
    }

    public function create()
    {
        $cities = City::all();
        $roles = Role::all();
        return view('mentors.create', get_defined_vars());
    }

    public function store(StoreUserRequest $request)
    {
        $mentor = new User();
        $mentor->name = $request->name;
        $mentor->email = $request->email;
        $mentor->password = bcrypt($request->password);
        $mentor->phone = $request->phone;
        $mentor->role_id = $request->role_id;
        $mentor->city_id = $request->city_id;
        $mentor->save();

        return redirect()->route('mentors.index')->with('message', 'Mentor Created Successfully');
    }

    public function show(User $mentor)
    {
        $mentor->load(['city', 'role', 'addresses']);
        return view('mentors.show', compact('mentor'));
    }

    public function edit(User $mentor)
    {
        $cities = City::all();
        $roles = Role::all();
        return view('mentors.edit', get_defined_vars());
    }

    public function update(UpdateUserRequest $request, User $mentor)
    {
        $mentor->name = $request->name;
        $mentor->email = ($request->email);
        $mentor->password = bcrypt($request->password);
        $mentor->city_id = $request->city_id;
        $mentor->role_id = $request->role_id;
        $mentor->save();

        return redirect()->route('mentors.index')->with('message', 'Mentor Updated Successfully');
    }

    public function destroy(User $mentor)
    {
        $mentor->delete();
        return redirect(route('mentors.index'))->with('message', 'Mentor Deleted Successfully');
    }

    public function updateStatus(Request $request, $id)
    {
        $mentor = User::findOrFail($id);
        $mentor->status = $request->input('status');
        $mentor->save();

        return redirect()->route('mentors.index')->with('message', 'Mentor Status Updated Successfully');
    }
}
