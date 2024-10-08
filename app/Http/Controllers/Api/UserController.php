<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function show(User $user)
    {
        $user->load(['assignments', 'quizzes']);

        $assignments = $user->assignments()->withPivot('file', 'date')->get();
        $quizzes = $user->quizzes()->withPivot('score', 'date')->get();

        return response()->json([
            'name' => $user->name,
            'email' => $user->email,
            'phone' => $user->phone,
            'city' => $user->city->name,
            'role' => $user->role->name,
            'assignments' => $assignments,
            'quizzes'  => $quizzes
        ]);
    }
}
