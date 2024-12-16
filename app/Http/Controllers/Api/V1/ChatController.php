<?php

namespace App\Http\Controllers\Api\V1;

use App\Services\UserService;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProfileResource;
use App\Traits\ApiResponder;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    use ApiResponder;

    public function sendMessage($user_id, Request $request, UserService $userService)
    {
        $message = $request->input('message');
        $userService->sendMessage($user_id, $message);
        $user = auth()->user();
        return $this->created(new ProfileResource($user), 'Message Sent');
    }
}
