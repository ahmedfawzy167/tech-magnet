<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\LoginResource;
use App\Http\Resources\ProfileResource;
use App\Traits\ApiResponder;
use Illuminate\Validation\Rules\Password;
use Tymon\JWTAuth\Exceptions\JWTException;


class AuthController extends Controller
{
    use ApiResponder;


    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'between:2,50'],
            'email' => ['required', 'string', 'email', 'unique:users', 'max:50'],
            'password' => ['required', Password::defaults(), 'confirmed'],
            'phone' => 'required|string|max:11',
            'city' => 'required|exists:cities,id',
            'role' => 'required|exists:roles,id',
        ]);

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

        return $this->created($user, "Registeration is Done");
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email|max:50',
            'password' => 'required|string|min:8',
        ]);

        $credentials = $request->only('email', 'password');
        if (!$token = JwtAuth::attempt($credentials)) {
            return response()->json(['error' => 'Invalid Credentials'], 401);
        }

        $user = Auth::user();
        return response()->json([
            'user' => new LoginResource($user),
            'message' => 'Login Successfully',
            'token' => $token
        ]);
    }

    public function logout(Request $request)
    {
        try {
            JWTAuth::parseToken()->invalidate($request->token);
        } catch (JWTException $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ]);
        }
        return $this->success("Logout Successfully");
    }

    public function refresh(Request $request)
    {
        $token = $request->bearerToken();

        if (!$token) {
            return response()->json([
                'message' => 'Token Not Found'
            ], 404);
        }

        try {
            $new_token = JWTAuth::parseToken()->refresh($token);
        } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
            return response()->json([
                'message' => 'Invalid Token'
            ], 401);
        }

        if ($new_token) {
            return response()->json([
                'Status' => "Success",
                'NewAccessToken' => $new_token
            ], 200);
        } else {
            return response()->json([
                'message' => 'Error'
            ], 404);
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
