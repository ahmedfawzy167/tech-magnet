<?php

namespace App\Http\Controllers\Api;

use App\Models\Session;
use Illuminate\Http\Request;
use App\Traits\MeetingZoom;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSessionRequest;
use App\Http\Resources\SessionResource;
use App\Traits\ApiResponder;

class SessionController extends Controller
{
    use MeetingZoom, ApiResponder;

    public function store(StoreSessionRequest $request)
    {
        $this->authorize('create', Session::class);
        $meeting = $this->createZoomMeeting($request);

        $meetingId = $meeting['id'];
        $meetingStartUrl = $meeting['start_url'];
        $meetingJoinUrl = $meeting['join_url'];

        $session = new Session();
        $session->topic = $request->topic;
        $session->description = $request->description;
        $session->start_date = $request->start_date;
        $session->user_id = auth()->user()->id;
        $session->course_id = $request->course;
        $session->meeting_id = $meetingId;
        $session->start_url = $meetingStartUrl;
        $session->join_url = $meetingJoinUrl;
        $session->save();

        return $this->created(new SessionResource($session), "Meeting Created Successfully");
    }

    public function index()
    {
        $this->authorize('viewAny', Session::class);
        $response = $this->getAllMeetings();

        if ($response['success']) {
            return $this->success($response['data'], "Meetings Retrieved Successfully");
        }

        return $this->serverError($response['message']);
    }


    public function destroy($id)
    {
        $session = Session::find($id);
        if (!$session) {
            return $this->notFound('Session Not Found');
        }

        $this->authorize('delete', $session);

        $deleteResponse = $this->deleteMeeting($session->meeting_id);

        if (!$deleteResponse['success']) {
            return $this->serverError($deleteResponse['message']);
        }

        $session->delete();
        return $this->success(new SessionResource($session), "Meeting Deleted Successfully");
    }
}
