<?php

namespace App\Http\Controllers\Api;

use App\Models\Recording;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\RecordingDetailsResource;

class RecordingController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Recording::class);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|between:2,50',
            'description' => 'required|max:500',
            'video_src'  => 'required|video/mp4,video/avi|max:14250',
            'user_id' => 'required|numeric:gt:0',
            'course_id' => 'required|numeric:gt:0',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

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

        return response()->json([
            "status" => "Success",
            "message" => "Recording Uploaded Successfully",
        ], 201);
    }

    public function show(Recording $recording)
    {
        if ($recording != null) {
            return new RecordingDetailsResource($recording);
        } else {
            return response()->json([
                "status"  => "error",
                "message"  => "Recording not found"
            ], 404);
        }
    }
}
