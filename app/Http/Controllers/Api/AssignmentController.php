<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Assignment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\AssignmentCollection;
use App\Traits\ApiResponder;

class AssignmentController extends Controller
{
    use ApiResponder;

    public function __construct()
    {
        $this->authorizeResource(Assignment::class);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|between:2,50',
            'description' => 'required|string|max:500',
            'deadline' => 'required|date_format:Y-m-d H:i:s',
            'course_id' => 'required|numeric|gt:0',
        ]);


        $assignment = new Assignment();
        $assignment->title = $request->title;
        $assignment->description = $request->description;
        $assignment->deadline = $request->deadline;
        $assignment->course_id = $request->course_id;
        $assignment->save();

        return $this->created($assignment, "Assignment Created Successfully!");
    }

    public function update(Request $request, Assignment $assignment)
    {
        $request->validate([
            'title' => 'required|string|between:2,50',
            'description' => 'required|string|max:500',
            'deadline' => 'required|date_format:Y-m-d H:i:s',
            'course_id' => 'required|numeric|gt:0',
        ]);

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
            $query->where('user_id', Auth::id());
        })->get();
        return $this->success(AssignmentCollection::collection($assignments));
    }

    public function attach(Request $request)
    {
        $user = User::find($request->user_id);
        $assignment = Assignment::find($request->assignment_id);

        $assignment->users()->attach($user, [
            'file' => $request->file,
            'date' => $request->date,
        ]);

        return $this->created($assignment, "Assignment Submitted Successfully!");
    }
}
