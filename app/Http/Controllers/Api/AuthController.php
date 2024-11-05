<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Traits\ApiResponder;
use Illuminate\Http\Request;
use App\Events\StudentRegistered;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\LoginResource;
use App\Http\Resources\ProfileResource;
use Tymon\JWTAuth\Exceptions\JWTException;


class AuthController extends Controller
{
    use ApiResponder;

    public function register(RegisterRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' =>  $request->phone,
            'city_id' =>  $request->city,
            'role_id' =>  $request->role,
        ]);

        activity()
            ->performedOn($user)
            ->causedBy($user)
            ->event('Registered')
            ->withProperties(['name' => $user->name])
            ->log('New User Registration');

        // Dispatch the event
        event(new StudentRegistered($user));
        return $this->created("Registeration is Done");
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email|max:50',
            'password' => 'required|string|min:8',
        ]);

        $credentials = $request->only('email', 'password');
        if (!$token = JwtAuth::attempt($credentials)) {
            return $this->unauthorized("Invalid Credentials");
        }
        $user = Auth::user();

        return $this->success([
            new LoginResource($user),
            'token' => $token
        ], 'Login Successfully');
    }

    public function logout(Request $request)
    {
        try {
            JWTAuth::parseToken()->invalidate($request->token);
        } catch (JWTException $e) {
            return $this->error($e->getMessage());
        }
        return $this->success("Logout Successfully");
    }

    public function refresh(Request $request)
    {
        $token = $request->bearerToken();

        if (!$token) {
            return $this->error('Token Not Found');
        }

        try {
            $new_token = JWTAuth::parseToken()->refresh($token);
        } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
            return $this->unauthorized('Token Invalid');
        }

        if ($new_token) {
            return $this->success(['NewAccessToken' => $new_token]);
        } else {
            return $this->error("Error Occured While Issuing The New Access Token");
        }
    }

    public function profile(Request $request)
    {
        $user = $request->user();
        return $this->success(new ProfileResource($user));
    }

    public function profileUpdate(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email|unique:users|max:50',
            'current_password' => 'required|current_password',
            'new_password' => 'required|string|min:12',
        ]);

        $user = Auth::user();
        $user->email = $request->email;
        $user->password = bcrypt($request->new_password);
        $user->save();

        return $this->success("Profile Updated Successfully");
    }
}
