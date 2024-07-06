<?php

namespace App\Http\Controllers\Api;

use App\Services\UserService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function sendMessage($user_id, Request $request, UserService $userService)
    {
        $message = $request->input('message');
        $userService->sendMessage($user_id, $message);
        return response()->json(['message' => 'Message sent'], 201);
    }
}
