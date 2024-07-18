<?php

namespace App\Http\Controllers\Api;

use App\Models\Objective;
use App\Http\Controllers\Controller;
use App\Http\Resources\ObjectiveCollection;
use Illuminate\Http\Request;

class ObjectiveController extends Controller
{
    public function index()
    {
        $objectives = Objective::with(['courses'])->get();

        return ObjectiveCollection::collection($objectives);
    }
}
