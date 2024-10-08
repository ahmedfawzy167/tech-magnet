<?php

namespace App\Http\Controllers\Admin;

use App\Models\{Recording, Course, User};
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRecordingRequest;
use App\Http\Requests\UpdateRecordingRequest;

class RecordingController extends Controller
{

    public function index()
    {
        $recordings = Recording::with(['course', 'user'])->get();
        return view('recordings.index', compact('recordings'));
    }

    public function create()
    {
        $courses = Course::all();
        $users = User::all();
        return view('recordings.create', compact('courses', 'users'));
    }

    public function store(StoreRecordingRequest $request)
    {
        $request->validated();

        $video = $request->file('video_src');
        $ext = $video->getClientOriginalExtension();
        $fileName = date("Y-m-d") . '.' .  $ext;
        $location = "public/recordings";
        $video->storeAs($location, $fileName);

        $recording = new Recording();
        $recording->title = $request->title;
        $recording->description = $request->description;
        $recording->video_src = $fileName;
        $recording->course_id = $request->course_id;
        $recording->user_id = $request->user_id;
        $recording->save();

        return redirect(route('recordings.index'))->with('message', 'Recording Created Successfully');
    }

    public function edit(Recording $recording)
    {
        $courses = Course::all();
        $users = User::all();
        return view('recordings.edit', compact('recording', 'courses', 'users'));
    }


    public function update(UpdateRecordingRequest $request, Recording $recording)
    {
        $request->validated();

        if ($request->hasFile('video_src')) {
            $video = $request->file('video_src');
            $fileName = $video->getClientOriginalName();
            $location = "public/recordings";
            $video->storeAs($location, $fileName);
        }

        $recording->title = $request->title;
        $recording->description = $request->description;
        $recording->video_src = $fileName;
        $recording->course_id = $request->course_id;
        $recording->user_id = $request->user_id;
        $recording->save();

        return redirect(route('recordings.index'))->with('message', 'Recording Updated Successfully');
    }


    public function show(Recording $recording)
    {
        $recording->load(['course', 'user']);
        return view('recordings.show', compact('recording'));
    }

    public function destroy(Recording $recording)
    {
        $recording->delete();
        return redirect()->route('recordings.index')->with('message', 'Recording Deleted Successfully');
    }
}
