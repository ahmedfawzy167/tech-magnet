<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuperSkill extends Model
{
    protected $table = "super_skills";

    protected $fillable = ['name','course_id'];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function skills()
    {
        return $this->hasMany(Skill::class);
    }

    use HasFactory;
}
