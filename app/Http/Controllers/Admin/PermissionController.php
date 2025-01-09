<?php

namespace App\Http\Controllers\Admin;

use App\Models\Permission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePermissionRequest;
use App\Http\Requests\UpdatePermissionRequest;

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


    public function store(StorePermissionRequest $request)
    {
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
    public function update(UpdatePermissionRequest $request, Permission $permission)
    {
        $permission->name = $request->name;
        $permission->save();

        return redirect(route('permissions.index'))->with('message', 'Permission Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Permission $permission)
    {
        if ($permission->roles()->exists()) {
            return redirect()->back()->withErrors([
                'error' => 'Permission is being Used by a Role'
            ]);
        }

        $permission->delete();
        return redirect(route('permissions.index'))->with('message', 'Permission Deleted Successfully');
    }
}
