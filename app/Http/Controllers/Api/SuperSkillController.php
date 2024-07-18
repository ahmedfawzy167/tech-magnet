<?php

namespace App\Http\Controllers\Api;

use App\Models\SuperSkill;
use App\Http\Resources\SuperSkillResource;
use App\Http\Controllers\Controller;
use App\Http\Resources\SuperSkillCollection;
use Illuminate\Http\Request;

class SuperSkillController extends Controller
{
    public function index()
    {
        $super_skills = SuperSkill::with('course')->get();
        return SuperSkillCollection::collection($super_skills);
    }

    public function show(SuperSkill $super_skill)
    {
        if ($super_skill != null) {
            return new SuperSkillResource($super_skill);
        } else {
            return response()->json([
                "status"  => "error",
                "message"  => "Super Skill not found"
            ], 404);
        }
    }
}
