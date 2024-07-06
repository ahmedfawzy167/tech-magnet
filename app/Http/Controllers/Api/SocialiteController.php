<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use Exception;

class SocialiteController extends Controller
{
    public function redirect()
    {
        $url = Socialite::driver('google')->redirect()->getTargetUrl();
        return response()->json($url, 302);
    }

    public function callback()
    {
        try {
            $user = Socialite::driver('google')->user();
            $findUser = User::where('social_id', $user->id)->first();
            if ($findUser) {
                Auth::login($findUser);
                return response()->json(['user' => $findUser, 'redirectUrl' => route('login')]);
            } else {
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'password' => bcrypt($user->password),
                    'social_id' => $user->id,
                    'social_type' => 'google',
                ]);
                Auth::login($newUser);
                return response()->json(['user' => $newUser, 'redirectUrl' => route('login')]);
            }
        } catch (Exception $e) {
            $e->getMessage();
        }
    }
}
