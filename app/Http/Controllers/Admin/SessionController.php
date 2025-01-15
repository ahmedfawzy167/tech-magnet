<?php

namespace App\Http\Controllers\Admin;

use App\Models\Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SessionController extends Controller
{
    public function index()
    {
        $sessions = Session::with(['course', 'user'])->get();
        return view('sessions.index', compact('sessions'));
    }

    public function destroy(Session $session)
    {
        $session->delete();
        return redirect(route('sessions.index'))->with('message', 'Session Deleted Successfully');
    }
}
