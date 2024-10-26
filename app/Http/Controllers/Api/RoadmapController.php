<?php

namespace App\Http\Controllers\Api;

use App\Models\Roadmap;
use App\Traits\ApiResponder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\RoadmapResource;

class RoadmapController extends Controller
{
    use ApiResponder;

    public function index()
    {
        $roadmaps = Roadmap::all();
        return $this->success(RoadmapResource::collection($roadmaps));
    }

    public function show($id)
    {
        $roadmap = Roadmap::find($id);

        if ($roadmap != null) {
            return $this->success(new RoadmapResource($roadmap));
        } else {
            return $this->notFound("Roadmap Not Found");
        }
    }
}
