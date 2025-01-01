<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreRecordingRequest;

class RecordingController extends Controller
{

    public function index()
    {
        $recordings = Storage::disk('public')->files('recordings');
        return view('recordings.index', compact('recordings'));
    }

    public function create()
    {
        return view('recordings.create');
    }

    public function store(StoreRecordingRequest $request)
    {
        $video = $request->file('video_src');
        $path = $video->store('Recordings', 'google');

        $fileName = $video->getClientOriginalName();

        $fileContent = Storage::disk('google')->get($path);
        Storage::disk('public')->put("recordings/{$fileName}", $fileContent);

        return redirect()->route('recordings.index')->with('message', 'Recording Created Successfully');
    }
}
