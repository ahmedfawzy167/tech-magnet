<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\ApiResponder;
use Laravel\Socialite\Facades\Socialite;
use Exception;
use Tymon\JWTAuth\Facades\JWTAuth;

class GithubController extends Controller
{
    use ApiResponder;

    public function redirect()
    {
        $url = Socialite::driver('github')->redirect()->getTargetUrl();
        return $this->success(['url' => $url], 'Redirecting to GitHub', 302);
    }

    public function callback()
    {
        try {
            $user = Socialite::driver('github')->stateless()->user();

            $findUser = User::where('social_id', $user->id)->first();

            if ($findUser) {
                $token = JWTAuth::fromUser($findUser);
                return $this->success(['user' => $findUser, 'token' => $token], 'Login successful');
            } else {
                $phone = '01137847742';
                $city_id = 1;
                $role_id = 1;

                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'phone' => $phone,
                    'city_id' => $city_id,
                    'role_id' => $role_id,
                    'password' => bcrypt($user->password),
                    'social_id' => $user->id,
                    'social_type' => 'github',
                ]);

                $token = JWTAuth::fromUser($newUser);

                return $this->success(['user' => $newUser, 'token' => $token], 'Account Created Successfully');
            }
        } catch (Exception $e) {
            return $this->serverError($e->getMessage());
        }
    }
}
