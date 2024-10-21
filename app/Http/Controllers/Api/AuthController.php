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
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use Tymon\JWTAuth\Exceptions\JWTException;


class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['only' => ['profile', 'logout', 'profileUpdate']]);
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|between:2,100',
            'email' => 'required|string|email|unique:users|max:100',
            'password' => ['required', Password::defaults(), 'confirmed'],
            'phone' => 'required|string|max:11',
            'city_id' => 'required|numeric|gt:0',
            'role_id' => 'required|numeric|gt:0',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' =>  $request->phone,
            'city_id' =>  $request->city_id,
            'role_id' =>  $request->role_id,
        ]);

        activity()
            ->performedOn($user)
            ->causedBy($user)
            ->event('Registered')
            ->withProperties(['name' => $user->name])
            ->log('New User Registration');

        return response()->json([
            'status' => "Success",
            'message' => "Registeration is Done",
            'user' => $user,
        ], 201);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email|max:100',
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
        return response()->json([
            'status' => 200,
            'message' => "Logout Successfully",
        ]);
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
                'New Access_token' => $new_token
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
        return new ProfileResource($user);
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

        return response()->json([
            "message" => "Profile Updated Successfully"
        ], 200);
    }
}
