<?php

namespace App\Http\Controllers\Api;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProjectResource;
use Illuminate\Support\Facades\Validator;

class ProjectController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Project::class);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file'  => 'required|file|mimes:pdf|max:2048',
            'user_id' => 'required|numeric:gt:0',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $file = $request->file('file');
        $fileName = $file->getClientOriginalName();
        $location = "public/projects";
        $file->storeAs($location, $fileName);

        $project = new Project();
        $project->file = $fileName;
        $project->user_id = $request->user_id;
        $project->save();

        return response()->json([
            "status" => "Success",
            "message" => "Project Created Successfully",
        ], 201);
    }

    public function update(Request $request, Project $project)
    {
        $validator = Validator::make($request->all(), [
            'status'  => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $project->status = $request->status;
        $project->update();

        return response()->json([
            "status"  => "Success",
            "message" => "Project Approved Successfully",
        ], 200);
    }


    public function index()
    {
        $projects = Project::all();
        return ProjectResource::collection($projects);
    }
}
