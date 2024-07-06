<?php

namespace App\Http\Controllers\Api;
use App\Models\Objective;
use App\Http\Resources\ObjectiveResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ObjectiveController extends Controller
{
    public function index()
    {
        $objectives = Objective::with(['courses'])->get();

        return ObjectiveResource::collection($objectives);
    }
    
}
