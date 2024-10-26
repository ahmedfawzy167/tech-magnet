<?php

namespace App\Http\Controllers\Api;

use App\Models\Schedule;
use App\Http\Resources\ScheduleResource;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Http\Resources\ScheduleCollection;
use App\Traits\ApiResponder;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    use ApiResponder;

    public function __construct()
    {
        $this->authorizeResource(Schedule::class);
    }

    public function index()
    {
        $schedules = Schedule::with('course')->get();
        return $this->success(ScheduleCollection::collection($schedules));
    }

    public function store(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date_format:Y-m-d',
            'end_date' => 'required|date_format:Y-m-d',
            'course_id' => 'required|numeric|gt:0',
        ]);

        $schedule = new Schedule();
        $schedule->start_date = $request->start_date;
        $schedule->end_date = $request->end_date;
        $schedule->course_id = $request->course_id;
        $schedule->save();

        return $this->created($schedule, "Schedule Created Successfully");
    }

    public function show(Schedule $schedule)
    {
        if ($schedule != null) {
            return $this->success(new ScheduleResource($schedule));
        } else {
            return $this->notFound("Schedule Not Found");
        }
    }

    public function update(Request $request, Schedule $schedule)
    {
        $request->validate([
            'start_date' => 'required|date_format:Y-m-d',
            'end_date' => 'required|date_format:Y-m-d',
            'course_id' => 'required|numeric|gt:0',
        ]);

        $schedule->start_date = $request->start_date;
        $schedule->end_date = $request->end_date;
        $schedule->course_id = $request->course_id;
        $schedule->save();

        return $this->success($schedule, "Schedule Updated Successfully!");
    }
}
