<?php

namespace App\Http\Controllers\Admin;

use App\Models\{Role, Permission};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = DB::table('roles')->get();
        return view('roles.index', compact('roles'));
    }

    public function create()
    {
        $permissions = Permission::all();
        return view('roles.create', compact('permissions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'permissions' => 'array',
            'permissions.*' => 'exists:permissions,id',
        ]);

        $role = new Role();
        $role->name = $request->name;
        $role->save();

        $role->permissions()->attach($request->input('permissions', []));

        return redirect()->route('roles.index')->with('message', 'Role Created Successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        $users = $role->users;
        $permissions = $role->permissions;
        return view('roles.show', compact('role', 'users','permissions'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        $permissions = Permission::all();
        return view('roles.edit', compact('role', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'permissions' => 'array',
            'permissions.*' => 'exists:permissions,id',
        ]);

        $role->name = $request->name;
        $role->save();

        $role->permissions()->sync($request->input('permissions', []));

        return redirect()->route('roles.index')->with('message', 'Role Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        $role->delete();
        return redirect(route('roles.index'))->with('message', 'Role Deleted Successfully');
    }
}
