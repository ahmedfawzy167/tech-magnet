<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    protected $fillable = ['title','content','super_skill_id'];

    public function superSkill()
    {
        return $this->belongsTo(SuperSkill::class);
    }

    public function studentProgress()
    {
        return $this->hasMany(StudentProgress::class);
    }

    use HasFactory;
}
