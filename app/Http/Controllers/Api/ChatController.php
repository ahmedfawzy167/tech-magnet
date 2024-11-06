<?php

namespace App\Http\Controllers\Api;

use App\Services\UserService;
use App\Http\Controllers\Controller;
use App\Traits\ApiResponder;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    use ApiResponder;

    public function sendMessage($user_id, Request $request, UserService $userService)
    {
        $message = $request->input('message');
        $userService->sendMessage($user_id, $message);
        return $this->created('Message Sent');
    }
}
