<?php

namespace App\Http\Controllers\Api;

use App\Models\Attendance;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\AttendanceCollection;
use App\Traits\ApiResponder;

class AttendanceController extends Controller
{
    use ApiResponder;

    public function __construct()
    {
        $this->authorizeResource(Attendance::class);
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|numeric|gt:0',
            'course_id' => 'required|numeric|gt:0',
            'date' => 'required|date_format:Y-m-d H:i:s',
            'attendance_status' => 'nullable|numeric'
        ]);

        $attendance = new Attendance();
        $attendance->user_id = $request->user_id;
        $attendance->course_id = $request->course_id;
        $attendance->date = $request->date;
        $attendance->attendance_status = $request->attendance_status;
        $attendance->save();

        return $this->created($attendance, "Attendance Created Successfully!");
    }


    public function update(Request $request, Attendance $attendance)
    {
        $request->validate([
            'user_id' => 'required|numeric|gt:0',
            'course_id' => 'required|numeric|gt:0',
            'date' => 'required|date_format:Y-m-d H:i:s',
            'attendance_status' => 'nullable|numeric'
        ]);

        $attendance->user_id = $request->user_id;
        $attendance->course_id = $request->course_id;
        $attendance->date = $request->date;
        $attendance->attendance_status = $request->attendance_status;
        $attendance->update();

        return $this->success($attendance, "Attendance Updated Successfully!");
    }

    public function index()
    {
        $attendances = Attendance::with(['user', 'course'])->get();
        return $this->success(AttendanceCollection::collection($attendances));
    }
}
