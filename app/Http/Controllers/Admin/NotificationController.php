<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function show($id)
    {
        $notification = Auth::guard('admin')->user()->notifications()->findOrFail($id);
        $notification->markAsRead();

        return view('notifications.show', compact('notification'));
    }
}
