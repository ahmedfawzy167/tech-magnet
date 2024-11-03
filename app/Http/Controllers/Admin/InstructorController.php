<?php

namespace App\Http\Controllers\Admin;

use App\Models\City;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;

class InstructorController extends Controller
{
    public function index()
    {
        $instructors = User::with('city')->where('role_id', 2)->get();
        return view('instructors.index', compact('instructors'));
    }

    public function create()
    {
        $cities = City::all();
        $roles = Role::all();
        return view('instructors.create', get_defined_vars());
    }

    public function store(StoreUserRequest $request)
    {

        $instructor = new User();
        $instructor->name = $request->name;
        $instructor->email = $request->email;
        $instructor->password = bcrypt($request->password);
        $instructor->phone = $request->phone;
        $instructor->role_id = $request->role_id;
        $instructor->city_id = $request->city_id;
        $instructor->save();

        return redirect()->route('instructors.index')->with('message', 'Instructor Created Successfully');
    }

    public function show(User $instructor)
    {
        $instructor->load(['city', 'role', 'addresses']);
        return view('instructors.show', compact('instructor'));
    }

    public function edit(User $instructor)
    {
        $cities = City::all();
        $roles = Role::all();
        return view('instructors.edit', get_defined_vars());
    }

    public function update(UpdateUserRequest $request, User $instructor)
    {

        $instructor->name = $request->name;
        $instructor->email = ($request->email);
        $instructor->password = bcrypt($request->password);
        $instructor->city_id = $request->city_id;
        $instructor->role_id = $request->role_id;
        $instructor->save();

        return redirect()->route('instructors.index')->with('message', 'Instructor Updated Successfully');
    }

    public function destroy(User $instructor)
    {
        $instructor->delete();
        return redirect()->route('instructors.index')->with('message', 'Instructor Deleted Successfully');
    }
}
