<?php

namespace App\Http\Controllers\Api;

use App\Models\Skill;
use App\Http\Resources\SkillResource;
use App\Http\Controllers\Controller;
use App\Http\Resources\SkillCollection;
use App\Traits\ApiResponder;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    use ApiResponder;

    public function index()
    {
        $skills = Skill::with('superSkill')->get();
        return $this->success(SkillCollection::collection($skills));
    }

    public function show(Skill $skill)
    {
        if ($skill != null) {
            return $this->success(new SkillResource($skill));
        } else {
            return $this->notFound("Skill Not Found");
        }
    }
}
