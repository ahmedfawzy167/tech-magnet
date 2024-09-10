<?php

namespace App\Http\Controllers\Admin;

use App\Models\Permission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $permissions = Permission::all();
        return view('permissions.index', compact('permissions'));
    }


    public function create()
    {
        return view('permissions.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:100']
        ]);

        $permission = new Permission();
        $permission->name = $request->name;
        $permission->save();
        return redirect(route('permissions.index'))->with('message', 'Permission Created Successfully');
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Permission $permission)
    {
        return view('permissions.edit', compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Permission $permission)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:100']
        ]);

        $permission->name = $request->name;
        $permission->save();

        return redirect(route('permissions.index'))->with('message', 'Permission Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Permission $permission)
    {
        $permission->delete();

        return redirect(route('permissions.index'))->with('message', 'Permission Deleted Successfully');
    }
}
