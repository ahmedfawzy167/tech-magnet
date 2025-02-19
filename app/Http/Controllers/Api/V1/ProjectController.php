<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Http\Resources\ProjectResource;
use App\Traits\ApiResponder;

class ProjectController extends Controller
{
    use ApiResponder;

    public function store(StoreProjectRequest $request)
    {
        if (!auth()->user()->hasRole('Student')) {
            return $this->forbidden('Access Forbidden');
        }
    
        $file = $request->file('file');
        $fileName = $file->getClientOriginalName();
        $location = "public/projects";
        $file->storeAs($location, $fileName);

        $project = new Project();
        $project->file = $fileName;
        $project->user_id = auth()->user()->id;
        $project->save();

        return $this->created($project, "Project Created Successfully");
    }

    public function update(UpdateProjectRequest $request, Project $project)
    {
        if (!auth()->user()->hasRole('Instructor')) {
            return $this->forbidden('Access Forbidden');
        }

        $project->status = $request->status;
        $project->update();

        return $this->success($project, "Project Approved Successfully");
    }


    public function index()
    {
        if (!auth()->user()->hasRole('Instructor')) {
            return $this->forbidden('Access Forbidden');
        }
        $projects = Project::all();
        return $this->success(ProjectResource::collection($projects));
    }
}
