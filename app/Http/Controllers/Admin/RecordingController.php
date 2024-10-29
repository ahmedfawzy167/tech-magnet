<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRecordingRequest;

class RecordingController extends Controller
{

    public function create()
    {
        return view('recordings.create');
    }

    public function store(StoreRecordingRequest $request)
    {
        $request->file('video_src')->store('Recordings', 'google');
        return redirect()->back()->with('message', 'Recording Created Successfully');
    }
}
