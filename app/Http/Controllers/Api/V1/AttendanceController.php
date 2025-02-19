<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Attendance;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAttendanceRequest;
use App\Http\Requests\UpdateAttendanceRequest;
use Illuminate\Http\Request;
use App\Http\Resources\AttendanceCollection;
use App\Traits\ApiResponder;

class AttendanceController extends Controller
{
    use ApiResponder;

    public function store(StoreAttendanceRequest $request)
    {
        if (!auth()->user()->hasRole('Mentor')) {
            return $this->forbidden('Access Forbidden');
        }
        $attendance = new Attendance();
        $attendance->user_id = auth()->user()->id;
        $attendance->course_id = $request->course_id;
        $attendance->date = $request->date;
        $attendance->attendance_status = $request->attendance_status;
        $attendance->save();

        return $this->created($attendance, "Attendance Created Successfully");
    }


    public function update(UpdateAttendanceRequest $request, Attendance $attendance)
    {
        if (!auth()->user()->hasRole('Mentor')) {
            return $this->forbidden('Access Forbidden');
        }
        $attendance->user_id = auth()->user()->id;
        $attendance->course_id = $request->course_id;
        $attendance->date = $request->date;
        $attendance->attendance_status = $request->attendance_status;
        $attendance->update();

        return $this->success($attendance, "Attendance Updated Successfully");
    }

    public function index()
    {
        if (!auth()->user()->hasRole('Mentor')) {
            return $this->forbidden('Access Forbidden');
        }
        $attendances = Attendance::with(['user', 'course'])->get();
        return $this->success(AttendanceCollection::collection($attendances));
    }
}
