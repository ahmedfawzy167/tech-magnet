<?php

namespace App\Http\Controllers\Admin;

use App\Models\{Role, User};
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;

class OperationController extends Controller
{
    public function index()
    {
        $operations = User::whereHasRole('Operations')->get();
        return view('operations.index', compact('operations'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('operations.create', get_defined_vars());
    }

    public function store(StoreUserRequest $request)
    {
        $operation = new User();
        $operation->name = $request->name;
        $operation->email = $request->email;
        $operation->password = bcrypt($request->password);
        $operation->phone = $request->phone;
        $operation->save();

        $role = Role::find($request->role_id);

        if ($role) {
            $operation->addRole($role);
        }

        return redirect()->route('operations.index')->with('message', 'Operation Specialist Created Successfully');
    }

    public function show(User $operation)
    {
        $operation->load('addresses');
        return view('operations.show', compact('operation'));
    }

    public function edit(User $operation)
    {
        $roles = Role::all();
        return view('operations.edit', get_defined_vars());
    }

    public function update(UpdateUserRequest $request, User $operation)
    {

        $operation->name = $request->name;
        $operation->email = ($request->email);
        $operation->password = bcrypt($request->password);
        $operation->phone = $request->phone;
        $operation->save();

        $role = Role::find($request->role_id);

        if ($role) {
            $operation->syncRoles([$role]);
        }

        return redirect()->route('operations.index')->with('message', 'Operation Specialist Updated Successfully');
    }

    public function destroy(User $operation)
    {
        $operation->delete();
        return redirect()->route('operations.index')->with('message', 'Operation Specialist Deleted Successfully');
    }

    public function updateStatus(Request $request, $id)
    {
        $operation = User::findOrFail($id);
        $operation->status = $request->input('status');
        $operation->save();

        return redirect()->route('operations.index')->with('message', 'Operation Specialist Status Updated Successfully');
    }
}
