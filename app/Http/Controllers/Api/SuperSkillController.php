<?php

namespace App\Http\Controllers\Api;

use App\Models\SuperSkill;
use App\Http\Resources\SuperSkillResource;
use App\Http\Controllers\Controller;
use App\Http\Resources\SuperSkillCollection;
use App\Traits\ApiResponder;
use Illuminate\Http\Request;

class SuperSkillController extends Controller
{
    use ApiResponder;

    public function index()
    {
        $super_skills = SuperSkill::with('course')->get();
        return $this->success(SuperSkillCollection::collection($super_skills));
    }

    public function show(SuperSkill $super_skill)
    {
        if ($super_skill != null) {
            return $this->success(new SuperSkillResource($super_skill));
        } else {
            return $this->notFound("Super Skill");
        }
    }
}
