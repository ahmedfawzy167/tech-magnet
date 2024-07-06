<?php

namespace App\Services;

use App\Events\ChatSent;
use App\Models\User;
use App\Models\Chat;
use Illuminate\Support\Facades\Auth;

class UserService
{
    public function getUser($user_id)
   {
      return User::where('id', $user_id)->first();
   } 

    public function sendMessage($user_id, $message)
    {
        $data['sender'] = Auth::user()->id;
        $data['receiver'] = $user_id;
        $data['message'] = $message;
        Chat::create($data);

        $receiver = $this->getUser($user_id);
        broadcast(new ChatSent($receiver, $message));
    }
}
