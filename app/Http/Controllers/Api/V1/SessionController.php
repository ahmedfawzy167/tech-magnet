<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Session;
use App\Traits\ApiResponder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\SessionResource;
use App\Http\Requests\StoreSessionRequest;
use App\Http\Requests\UpdateSessionRequest;
use App\Traits\ZoomMeeting;

class SessionController extends Controller
{
    use ZoomMeeting, ApiResponder;

    public function store(StoreSessionRequest $request)
    {
        $this->authorize('create', Session::class);

        try {
            $meeting = $this->createMeeting($request);

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

            return $this->created($meeting, "Meeting Created Successfully");
        } catch (\Exception $e) {
            return $this->serverError($e->getMessage());
        }
    }

    public function update(UpdateSessionRequest $request, Session $session)
    {
        $this->authorize('update', $session);

        try {
            $this->updateMeeting($session->meeting_id, $request);
            if ($session) {
                $session->topic = $request->topic;
                $session->description = $request->description;
                $session->start_date = $request->start_date;
                $session->save();
            }
            return $this->success(new SessionResource($session), "Meeting Updated Successfully");
        } catch (\Exception $e) {
            return $this->serverError($e->getMessage());
        }
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

    public function show($id)
    {
        $session = Session::find($id);
        $response = $this->getMeetingById($session->meeting_id);

        if ($response['success']) {
            return $this->success($response['data'], "Meeting Viewed Successfully");
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
