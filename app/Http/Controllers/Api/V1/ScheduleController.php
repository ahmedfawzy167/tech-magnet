<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Schedule;
use App\Http\Resources\ScheduleResource;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreScheduleRequest;
use App\Http\Requests\UpdateScheduleRequest;
use App\Http\Resources\ScheduleCollection;
use App\Traits\ApiResponder;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    use ApiResponder;


    public function index()
    {
        if (!auth()->user()->hasRole('Operations')) {
            return $this->forbidden('Access Forbidden');
        }
        $schedules = Schedule::with('course')->get();
        return $this->success(ScheduleCollection::collection($schedules));
    }

    public function store(StoreScheduleRequest $request)
    {
        if (!auth()->user()->hasRole('Operations')) {
            return $this->forbidden('Access Forbidden');
        }
        $schedule = new Schedule();
        $schedule->start_date = $request->start_date;
        $schedule->end_date = $request->end_date;
        $schedule->course_id = $request->course_id;
        $schedule->save();

        return $this->created($schedule, "Schedule Created Successfully");
    }

    public function show(Schedule $schedule)
    {
        if (!auth()->user()->hasRole('Operations')) {
            return $this->forbidden('Access Forbidden');
        }
        if ($schedule != null) {
            return $this->success(new ScheduleResource($schedule));
        } else {
            return $this->notFound("Schedule Not Found");
        }
    }

    public function update(UpdateScheduleRequest $request, Schedule $schedule)
    {
        if (!auth()->user()->hasRole('Operations')) {
            return $this->forbidden('Access Forbidden');
        }
        $schedule->start_date = $request->start_date;
        $schedule->end_date = $request->end_date;
        $schedule->course_id = $request->course_id;
        $schedule->save();

        return $this->success($schedule, "Schedule Updated Successfully");
    }
}
