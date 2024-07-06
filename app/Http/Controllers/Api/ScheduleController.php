<?php

namespace App\Http\Controllers\Api;

use App\Models\Schedule;
use App\Http\Resources\ScheduleResource;
use App\Http\Resources\ScheduleDetailsResource;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Schedule::class);
    }

    public function index()
    {
        $schedules = Schedule::with('course')->get();
        return ScheduleResource::collection($schedules);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'start_date' => 'required|date_format:Y-m-d',
            'end_date' => 'required|date_format:Y-m-d',
            'course_id' => 'required|numeric|gt:0',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $schedule = new Schedule();
        $schedule->start_date = $request->start_date;
        $schedule->end_date = $request->end_date;
        $schedule->course_id = $request->course_id;
        $schedule->save();

        return response()->json([
            "status" => 'Success',
            "message" => "Schedule Created Successfully!",
        ], 201);
    }

    public function show(Schedule $schedule)
    {
        if ($schedule != null) {
            return new ScheduleDetailsResource($schedule);
        } else {
            return response()->json([
                "message" => "Schedule Not Found"
            ], 404);
        }
    }

    public function update(Request $request, Schedule $schedule)
    {
        $validator = Validator::make($request->all(), [
            'start_date' => 'required|date_format:Y-m-d',
            'end_date' => 'required|date_format:Y-m-d',
            'course_id' => 'required|numeric|gt:0',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $schedule->start_date = $request->start_date;
        $schedule->end_date = $request->end_date;
        $schedule->course_id = $request->course_id;
        $schedule->save();

        return response()->json([
            "status" => 'Success',
            "message" => "Schedule Updated Successfully!",
        ], 200);
    }
}
