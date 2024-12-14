<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\ApiResponder;
use Laravel\Socialite\Facades\Socialite;
use Exception;
use Tymon\JWTAuth\Facades\JWTAuth;

class LinkedinController extends Controller
{
    use ApiResponder;

    public function redirect()
    {
        $url = Socialite::driver('linkedin')->redirect()->getTargetUrl();
        return $this->success(['url' => $url], 'Redirecting to LinkedIn', 302);
    }

    public function callback()
    {
        try {
            $user = Socialite::driver('linkedin')->user();
            $findUser = User::where('social_id', $user->id)->first();

            if ($findUser) {
                $token = JWTAuth::fromUser($findUser);
                return response()->json(['user' => $findUser, 'token' => $token], 200);
            } else {
                $phone = '01234567890';
                $city_id = 1;
                $role_id = 2;

                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'password' => bcrypt($user->password),
                    'phone' => $phone,
                    'city_id' => $city_id,
                    'role_id' => $role_id,
                    'social_id' => $user->id,
                    'social_type' => 'linkedin',
                ]);

                // Generate JWT Token
                $token = JWTAuth::fromUser($newUser);
                return response()->json(['user' => $newUser, 'token' => $token], 201);
            }
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
