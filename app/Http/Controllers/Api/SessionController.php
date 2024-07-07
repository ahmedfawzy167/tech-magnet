<?php

namespace App\Http\Controllers\Api;

use App\Models\Session;
use Illuminate\Http\Request;
use App\Traits\MeetingZoomTrait;
use App\Http\Controllers\Controller;
use App\Http\Resources\SessionResource;
use Illuminate\Support\Facades\Validator;

class SessionController extends Controller
{
    use MeetingZoomTrait;

    public function __construct()
    {
        $this->authorizeResource(Session::class);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'topic' => 'required|string|alpha|between:2,50',
            'description' => 'required|alpha|max:500',
            'start_date' => 'required|date_format:Y-m-d H:i:s',
            'course_id' => 'required|numeric|gt:0',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $meeting = $this->createZoomMeeting($request);

        $meetingId = $meeting['id'];
        $meetingStartUrl = $meeting['start_url'];
        $meetingJoinUrl = $meeting['join_url'];

        $session = new Session();
        $session->topic = $request->topic;
        $session->description = $request->description;
        $session->start_date = $request->start_date;
        $session->user_id = auth()->user()->id;
        $session->course_id = $request->course_id;
        $session->meeting_id = $meetingId;
        $session->start_url = $meetingStartUrl;
        $session->join_url = $meetingJoinUrl;
        $session->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Meeting Created Successfully',
            'session' => $session
        ], 201);
    }

    public function index()
    {
        $sessions = Session::all();
        return SessionResource::collection($sessions);
    }
}
