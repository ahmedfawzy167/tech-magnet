<?php

namespace App\Http\Controllers\Admin;

use App\Models\{Role, User};
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;

class MentorController extends Controller
{
    public function index()
    {
        $mentors = User::whereHasRole('Mentor')->get();
        return view('mentors.index', compact('mentors'));
    }

    public function create()
    {
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
        $mentor->save();

        $role = Role::find($request->role_id);

        if ($role) {
            $mentor->addRole($role);
        }

        return redirect()->route('mentors.index')->with('message', 'Mentor Created Successfully');
    }

    public function show(User $mentor)
    {
        $mentor->load('addresses');
        return view('mentors.show', compact('mentor'));
    }

    public function edit(User $mentor)
    {
        $roles = Role::all();
        return view('mentors.edit', get_defined_vars());
    }

    public function update(UpdateUserRequest $request, User $mentor)
    {
        $mentor->name = $request->name;
        $mentor->email = ($request->email);
        $mentor->password = bcrypt($request->password);
        $mentor->phone = $request->phone;
        $mentor->save();

        $role = Role::find($request->role_id);

        if ($role) {
            $mentor->syncRoles([$role]);
        }

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
