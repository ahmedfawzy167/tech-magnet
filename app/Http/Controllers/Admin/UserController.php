<?php

namespace App\Http\Controllers\Admin;

use App\Models\City;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use App\Http\Requests\StoreUserRequest;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

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

        Session::flash('message', 'User is Created Successfully');
        return redirect(route('users.index'));
    }

    public function show(User $user)
    {
        $user->load('city');
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
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|alpha|between:2,100',
            'email' => 'required|string|max:400',
            'password' => 'required|string|min:8',
            'city_id' => 'required|numeric|gt:0',
            'role_id' => 'required|numeric|gt:0',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user->name = $request->name;
        $user->email = ($request->email);
        $user->password = bcrypt($request->password);
        $user->city_id = $request->city_id;
        $user->role_id = $request->role_id;
        $user->update();

        Session::flash('message', 'User is Updated Successfully');
        return redirect(route('users.index'));
    }

    public function destroy(User $user)
    {
        $user->delete();
        Session::flash('message', 'User is Deleted Successfully');
        return redirect(route('users.index'));
    }
}
