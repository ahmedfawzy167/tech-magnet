<?php

namespace App\Http\Controllers\Api;

use App\Models\Session;
use Illuminate\Http\Request;
use App\Traits\MeetingZoom;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSessionRequest;
use App\Http\Resources\SessionCollection;
use App\Traits\ApiResponder;

class SessionController extends Controller
{
    use MeetingZoom, ApiResponder;

    public function __construct()
    {
        $this->authorizeResource(Session::class);
    }

    public function store(StoreSessionRequest $request)
    {
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
