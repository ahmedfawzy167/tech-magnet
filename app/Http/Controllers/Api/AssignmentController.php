<?php

namespace App\Http\Controllers\Api;

use App\Models\Assignment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAssignmentRequest;
use App\Http\Requests\UpdateAssignmentRequest;
use App\Http\Resources\AssignmentCollection;
use App\Traits\ApiResponder;

class AssignmentController extends Controller
{
    use ApiResponder;

    public function __construct()
    {
        $this->authorizeResource(Assignment::class);
    }

    public function store(StoreAssignmentRequest $request)
    {
        $assignment = new Assignment();
        $assignment->title = $request->title;
        $assignment->description = $request->description;
        $assignment->deadline = $request->deadline;
        $assignment->course_id = $request->course_id;
        $assignment->save();

        return $this->created($assignment, "Assignment Created Successfully!");
    }

    public function update(UpdateAssignmentRequest $request, Assignment $assignment)
    {
        $assignment->title = $request->title;
        $assignment->description = $request->description;
        $assignment->deadline = $request->deadline;
        $assignment->course_id = $request->course_id;
        $assignment->save();

        return $this->success($assignment, "Assignment Updated Successfully!");
    }

    public function index()
    {
        $assignments = Assignment::whereHas('users', function ($query) {
            $query->where('user_id', auth()->id());
        })->get();
        return $this->success(AssignmentCollection::collection($assignments));
    }

    public function attach(Request $request)
    {
        $user = auth()->user();
        $assignment = Assignment::find($request->assignment_id);

        $assignment->users()->attach($user, [
            'file' => $request->file,
            'date' => $request->date,
        ]);

        return $this->created($assignment, "Assignment Submitted Successfully!");
    }
}
