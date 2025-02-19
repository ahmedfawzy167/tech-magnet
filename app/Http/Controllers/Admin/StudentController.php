<?php

namespace App\Http\Controllers\Admin;

use App\Models\{Role, User};
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;

class StudentController extends Controller
{
    public function index()
    {
        $students = User::whereHasRole('Student')->get();
        return view('students.index', compact('students'));
    }

    public function create()
    {
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
        $student->save();

        $role = Role::find($request->role_id);

        if ($role) {
            $student->addRole($role);
        }

        return redirect()->route('students.index')->with('message', 'Student Created Successfully');
    }

    public function show(User $student)
    {
        $student->load('addresses');
        return view('students.show', compact('student'));
    }

    public function edit(User $student)
    {
        $roles = Role::all();
        return view('students.edit', get_defined_vars());
    }

    public function update(UpdateUserRequest $request, User $student)
    {
        $student->name = $request->name;
        $student->email = ($request->email);
        $student->password = bcrypt($request->password);
        $student->phone = $request->phone;
        $student->save();

        $role = Role::find($request->role_id);

        if ($role) {
            $student->syncRoles([$role]);
        }

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

    public function block(Request $request,$id)
  {
    $student = User::findOrFail($id);
    $duration = $request->input('duration');
    $unit = $request->input('unit', 'minutes');

    $student->blockUser($duration, $unit);
    return redirect()->route('students.index')->with('message', 'Student Blocked Successfully');

  }

    public function unblock($id)
  {
     $student = User::findOrFail($id);
     $student->unblockUser();
     return redirect()->route('students.index')->with('message', 'Student UnBlocked Successfully');
  }


}
