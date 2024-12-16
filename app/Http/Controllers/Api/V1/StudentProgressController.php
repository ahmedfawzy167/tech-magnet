<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\StudentProgress;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStudentProgressRequest;
use App\Http\Requests\UpdateStudentProgressRequest;
use App\Http\Resources\StudentProgressCollection;
use Illuminate\Http\Request;
use App\Http\Resources\StudentProgressResource;
use App\Traits\ApiResponder;

class StudentProgressController extends Controller
{
    use ApiResponder;

    public function __construct()
    {
        $this->authorizeResource(StudentProgress::class);
    }

    public function store(StoreStudentProgressRequest $request)
    {
        $student_progress = new StudentProgress();
        $student_progress->rank = $request->rank;
        $student_progress->total_points = $request->total_points;
        $student_progress->points_earned = $request->points_earned;
        $student_progress->date = $request->date;
        $student_progress->user_id = auth()->user()->id;
        $student_progress->course_id = $request->course_id;
        $student_progress->skill_id = $request->skill_id;
        $student_progress->save();

        return $this->created($student_progress, "Progress Created Successfully!");
    }

    public function update(UpdateStudentProgressRequest $request, StudentProgress $student_progress)
    {
        $student_progress->rank = $request->rank;
        $student_progress->total_points = $request->total_points;
        $student_progress->points_earned = $request->points_earned;
        $student_progress->date = $request->date;
        $student_progress->user_id = auth()->user()->id;
        $student_progress->course_id = $request->course_id;
        $student_progress->skill_id = $request->skill_id;
        $student_progress->update();

        return $this->success($student_progress, "Progress Updated Successfully");
    }

    public function index()
    {
        $student_progress = StudentProgress::with(['user', 'course', 'skill'])->get();
        return $this->success(StudentProgressCollection::collection($student_progress));
    }

    public function show(StudentProgress $student_progress)
    {
        if ($student_progress != null) {
            return $this->success(new StudentProgressResource($student_progress));
        } else {
            return $this->notFound("Progress Not Found");
        }
    }
}
