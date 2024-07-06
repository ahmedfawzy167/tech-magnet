<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::all();
        return view('roles.index', compact('roles'));
    }


    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        $users = $role->users;
        return view('roles.show', compact('role','users'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        return view('roles.edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,Role $role)
    {
        $request->validate([
            'name'=> ['required','string','max:100']
        ]);

        $role->name = $request->name;
        $role->update();
        Session::flash('message','Role is Update Successfully');
        return redirect(route('roles.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        $role->delete();
        Session::flash('message','Role is Deleted Successfully');
        return redirect(route('roles.index'));
    }
}
