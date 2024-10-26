<?php

namespace App\Http\Controllers\Api;

use App\Models\Recording;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\RecordingResource;
use App\Traits\ApiResponder;

class RecordingController extends Controller
{
    use ApiResponder;

    public function __construct()
    {
        $this->authorizeResource(Recording::class);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|between:2,50',
            'description' => 'required|max:500',
            'video_src'  => 'required|video/mp4,video/avi|max:14250',
            'user_id' => 'required|numeric:gt:0',
            'course_id' => 'required|numeric:gt:0',
        ]);


        $video = $request->file('video_src');
        $videoName = $video->getClientOriginalName();
        $location = "public/recordings";
        $video->storeAs($location, $videoName);

        $recording = new Recording();
        $recording->title = $request->title;
        $recording->description = $request->description;
        $recording->video_src = $videoName;
        $recording->user_id = $request->user_id;
        $recording->course_id = $request->course_id;
        $recording->save();

        return $this->created($recording, "Recording Uploaded Successfully");
    }

    public function show(Recording $recording)
    {
        if ($recording != null) {
            return $this->success(new RecordingResource($recording));
        } else {
            return $this->notFound("Recording not found");
        }
    }
}
