<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Assignment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\AssignmentCollection;

class AssignmentController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Assignment::class);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|between:2,50',
            'description' => 'required|string|max:500',
            'deadline' => 'required|date_format:Y-m-d H:i:s',
            'course_id' => 'required|numeric|gt:0',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $assignment = new Assignment();
        $assignment->title = $request->title;
        $assignment->description = $request->description;
        $assignment->deadline = $request->deadline;
        $assignment->course_id = $request->course_id;
        $assignment->save();

        return response()->json([
            "status" => 'Success',
            "message" => "Assignment Created Successfully!",
        ], 201);
    }

    public function update(Request $request, Assignment $assignment)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|between:2,50',
            'description' => 'required|string|max:500',
            'deadline' => 'required|date_format:Y-m-d H:i:s',
            'course_id' => 'required|numeric|gt:0',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $assignment->title = $request->title;
        $assignment->description = $request->description;
        $assignment->deadline = $request->deadline;
        $assignment->course_id = $request->course_id;
        $assignment->save();

        return response()->json([
            "status" => 'Success',
            "message" => "Assignment Updated Successfully!",
        ], 200);
    }

    public function index()
    {
        $assignments = Assignment::whereHas('users', function ($query) {
            $query->where('user_id', Auth::id());
        })->get();
        return AssignmentCollection::collection($assignments);
    }

    public function attach(Request $request)
    {
        $user = User::find($request->user_id);
        $assignment = Assignment::find($request->assignment_id);

        $assignment->users()->attach($user, [
            'file' => $request->file,
            'date' => $request->date,
        ]);

        return response()->json([
            "message" => "Assignments Submitted Successfully"
        ]);
    }
}
