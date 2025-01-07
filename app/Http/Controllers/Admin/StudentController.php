<?php

namespace App\Http\Controllers\Admin;

use App\Models\{City, Role, User};
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;

class StudentController extends Controller
{
    public function index()
    {
        $students = User::with('city')->where('role_id', 1)->get();
        return view('students.index', compact('students'));
    }

    public function create()
    {
        $cities = City::all();
        $roles = Role::all();
        return view('students.create', get_defined_vars());
    }

    public function store(StoreUserRequest $request)
    {
        $student = new User();
        $student->name = $request->name;
        $student->email = $request->email;
        $student->password = bcrypt($request->password);
        $student->phone = $request->phone;
        $student->role_id = $request->role_id;
        $student->city_id = $request->city_id;
        $student->save();

        return redirect()->route('students.index')->with('message', 'Student Created Successfully');
    }

    public function show(User $student)
    {
        $student->load(['city', 'role', 'addresses']);
        return view('students.show', compact('student'));
    }

    public function edit(User $student)
    {
        $cities = City::all();
        $roles = Role::all();
        return view('students.edit', get_defined_vars());
    }

    public function update(UpdateUserRequest $request, User $student)
    {
        $student->name = $request->name;
        $student->email = ($request->email);
        $student->password = bcrypt($request->password);
        $student->city_id = $request->city_id;
        $student->role_id = $request->role_id;
        $student->save();

        return redirect()->route('students.index')->with('message', 'Student Updated Successfully');
    }

    public function destroy(User $student)
    {
        $student->delete();
        return redirect(route('students.index'))->with('message', 'Student Deleted Successfully');
    }

    public function updateStatus(Request $request, $id)
    {
        $student = User::findOrFail($id);
        $student->status = $request->input('status');
        $student->save();

        return redirect()->route('students.index')->with('message', 'Student Status Updated Successfully');
    }
}
