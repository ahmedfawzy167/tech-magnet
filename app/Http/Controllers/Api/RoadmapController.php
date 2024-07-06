<?php

namespace App\Http\Controllers\Api;

use App\Models\Roadmap;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RoadmapController extends Controller
{
    public function index()
    {
        $roadmaps = Roadmap::all();
        return response()->json($roadmaps);
    }

    public function show($id)
    {
        $roadmap = Roadmap::find($id);
        
        if($roadmap != null){
           return response()->json([
             "status" => "success",
             "roadmap" => $roadmap
           ],200);
        }
        else{
            return response()->json([
                "status"  => "Error",
                "message"  => "Roadmap Not Found"
            ],404); 
        }
    }
}
