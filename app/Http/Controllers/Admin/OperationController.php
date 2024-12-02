<?php

namespace App\Http\Controllers\Admin;

use App\Models\City;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;

class OperationController extends Controller
{
    public function index()
    {
        $operations = User::with('city')->where('role_id', 3)->get();;
        return view('operations.index', compact('operations'));
    }

    public function create()
    {
        $cities = City::all();
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
        $operation->role_id = $request->role_id;
        $operation->city_id = $request->city_id;
        $operation->save();

        return redirect()->route('operations.index')->with('message', 'Operation Created Successfully');
    }

    public function show(User $operation)
    {
        $operation->load(['city', 'role', 'addresses']);
        return view('operations.show', compact('operation'));
    }

    public function edit(User $operation)
    {
        $cities = City::all();
        $roles = Role::all();
        return view('operations.edit', get_defined_vars());
    }

    public function update(UpdateUserRequest $request, User $operation)
    {

        $operation->name = $request->name;
        $operation->email = ($request->email);
        $operation->password = bcrypt($request->password);
        $operation->city_id = $request->city_id;
        $operation->role_id = $request->role_id;
        $operation->save();

        return redirect()->route('operations.index')->with('message', 'Operation Updated Successfully');
    }

    public function destroy(User $operation)
    {
        $operation->delete();
        return redirect()->route('operations.index')->with('message', 'Operation Deleted Successfully');
    }

    public function updateStatus(Request $request, $id)
    {
        $operation = User::findOrFail($id);
        $operation->status = $request->input('status');
        $operation->save();

        return redirect()->route('operations.index')->with('message', 'Operation Specialist Status Updated Successfully');
    }
}
