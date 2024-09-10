<?php

namespace App\Http\Controllers\Admin;

use App\Models\{User, City, Role};
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use App\Http\Requests\StoreUserRequest;

class UserController extends Controller
{
    public function index()
    {
        $users = Cache::rememberForever('users', function () {
            return User::with(['city', 'role'])->get();
        });

        return view('users.index', compact('users'));
    }

    public function create()
    {
        $cities = City::all();
        $roles = Role::all();
        return view('users.create', get_defined_vars());
    }

    public function store(StoreUserRequest $request)
    {
        $request->validated();

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->phone = $request->phone;
        $user->role_id = $request->role_id;
        $user->city_id = $request->city_id;
        $user->save();

        return redirect(route('users.index'))->with('message', 'User Created Successfully');
    }

    public function show(User $user)
    {
        $user->load(['city', 'role']);
        return view('users.show', compact('user'));
    }

    public function edit(User $user)
    {
        $cities = City::all();
        $roles = Role::all();
        return view('users.edit', get_defined_vars());
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|between:2,100',
            'email' => 'required|string|max:50',
            'password' => 'required|string|min:8',
            'city_id' => 'required|numeric|gt:0',
            'role_id' => 'required|numeric|gt:0',
        ]);

        $user->name = $request->name;
        $user->email = ($request->email);
        $user->password = bcrypt($request->password);
        $user->city_id = $request->city_id;
        $user->role_id = $request->role_id;
        $user->save();

        return redirect(route('users.index'))->with('message', 'User Updated Successfully');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect(route('users.index'))->with('message', 'User Deleted Successfully');
    }
}
