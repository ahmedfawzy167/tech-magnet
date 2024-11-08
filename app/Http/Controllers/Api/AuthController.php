<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Traits\ApiResponder;
use Illuminate\Http\Request;
use App\Events\StudentRegistered;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\LoginResource;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Http\Resources\ProfileResource;
use App\Http\Resources\RegisterResource;
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

        // Fire the Event
        event(new StudentRegistered($user));
        return $this->created(new RegisterResource($user), "Registeration is Done");
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');
        if (!$token = JwtAuth::attempt($credentials)) {
            return $this->unauthorized("Invalid Credentials");
        }

        $user = JwtAuth::user();

        return $this->success([
            'user' => new LoginResource($user),
            'token' => $token,
        ], 'Login Successfully');
    }

    public function logout(Request $request)
    {
        try {
            JWTAuth::parseToken()->invalidate($request->token);
        } catch (JWTException $e) {
            return $this->serverError($e->getMessage());
        }
        $user = request()->user();
        return $this->success(new LoginResource($user), "Logout Successfully");
    }

    public function refresh(Request $request)
    {
        $token = $request->bearerToken();

        if (!$token) {
            return $this->notFound('Token Not Found');
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

    public function profileUpdate(UpdateProfileRequest $request)
    {
        $user = request()->user();
        $user->email = $request->email;
        $user->password = bcrypt($request->new_password);
        $user->save();

        return $this->success(new ProfileResource($user), "Profile Updated Successfully");
    }
}
