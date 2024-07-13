<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Activitylog\Models\Activity;

class ActivityLogController extends Controller
{
    public function index()
    {
        $lastActivity = Activity::all()->last(); //returns the last logged activity
        return view('activity-logs.index',compact('lastActivity'));
    }
}
