<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;

class InstructorController extends Controller
{
    public function index()
    {
        $instructors = User::whereHasRole('Instructor')->get();
        return view('instructors.index', compact('instructors'));
    }

    public function create()
    {
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
        $instructor->save();

        $role = Role::find($request->role_id);

        if ($role) {
            $instructor->addRole($role);
        }

        return redirect()->route('instructors.index')->with('message', 'Instructor Created Successfully');
    }

    public function show(User $instructor)
    {
        $instructor->load('addresses');
        return view('instructors.show', compact('instructor'));
    }

    public function edit(User $instructor)
    {
        $roles = Role::all();
        return view('instructors.edit', get_defined_vars());
    }

    public function update(UpdateUserRequest $request, User $instructor)
    {
        $instructor->name = $request->name;
        $instructor->email = ($request->email);
        $instructor->password = bcrypt($request->password);
        $instructor->phone = $request->phone;
        $instructor->save();

        $role = Role::find($request->role_id);

        if ($role) {
            $instructor->syncRoles([$role]);
        }

        return redirect()->route('instructors.index')->with('message', 'Instructor Updated Successfully');
    }

    public function destroy(User $instructor)
    {
        $instructor->delete();
        return redirect()->route('instructors.index')->with('message', 'Instructor Deleted Successfully');
    }

    public function updateStatus(Request $request, $id)
    {
        $instructor = User::findOrFail($id);
        $instructor->status = $request->input('status');
        $instructor->save();

        return redirect()->route('instructors.index')->with('message', 'Instructor Status Updated Successfully');
    }
}
