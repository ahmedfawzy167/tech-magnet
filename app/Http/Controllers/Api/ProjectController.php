<?php

namespace App\Http\Controllers\Api;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProjectResource;
use App\Traits\ApiResponder;
use Illuminate\Support\Facades\Validator;

class ProjectController extends Controller
{
    use ApiResponder;

    public function __construct()
    {
        $this->authorizeResource(Project::class);
    }

    public function store(Request $request)
    {
        $request->validate([
            'file'  => 'required|file|mimes:pdf|max:2048',
            'user_id' => 'required|numeric:gt:0',
        ]);


        $file = $request->file('file');
        $fileName = $file->getClientOriginalName();
        $location = "public/projects";
        $file->storeAs($location, $fileName);

        $project = new Project();
        $project->file = $fileName;
        $project->user_id = $request->user_id;
        $project->save();

        return $this->created($project, "Project Created Successfully");
    }

    public function update(Request $request, Project $project)
    {
        $request->validate([
            'status'  => 'required|string',
        ]);

        $project->status = $request->status;
        $project->update();

        return $this->success($project, "Project Approved Successfully");
    }


    public function index()
    {
        $projects = Project::all();
        return $this->success(ProjectResource::collection($projects));
    }
}
