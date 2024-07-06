<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentProgress extends Model
{
    protected $fillable = ['rank','total_points','points_earned','date','user_id','course_id','skill_id'];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function skill()
    {
        return $this->belongsTo(Skill::class);
    }

    use HasFactory;
}
