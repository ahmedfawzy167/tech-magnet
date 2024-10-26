<?php

namespace App\Http\Controllers\Api;

use App\Models\Session;
use Illuminate\Http\Request;
use App\Traits\MeetingZoomTrait;
use App\Http\Controllers\Controller;
use App\Http\Resources\SessionCollection;
use App\Traits\ApiResponder;
use Illuminate\Support\Facades\Validator;

class SessionController extends Controller
{
    use MeetingZoomTrait, ApiResponder;

    public function __construct()
    {
        $this->authorizeResource(Session::class);
    }

    public function store(Request $request)
    {
        $request->validate([
            'topic' => 'required|string|between:2,50',
            'description' => 'required|max:500',
            'start_date' => 'required|date_format:Y-m-d H:i:s',
            'course_id' => 'required|numeric|gt:0',
        ]);

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

        return $this->created($session, "Meeting Created Successfully");
    }

    public function index()
    {
        $sessions = Session::all();
        return $this->success(SessionCollection::collection($sessions));
    }
}
