<?php

namespace App\Http\Controllers\Api;

use App\Models\SuperSkill;
use App\Http\Resources\SuperSkillResource;
use App\Http\Resources\SuperSkillDetailsResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SuperSkillController extends Controller
{
    public function index()
    {
        $super_skills = SuperSkill::with('course')->get();
        return SuperSkillResource::collection($super_skills);
    }

    public function show(SuperSkill $super_skill)
    {
        if ($super_skill != null) {
            return new SuperSkillDetailsResource($super_skill);
        } else {
            return response()->json([
                "status"  => "error",
                "message"  => "Super Skill not found"
            ], 404);
        }
    }
}
