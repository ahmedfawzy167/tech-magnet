<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    protected $fillable = ['title','description','file','file_type','course_id'];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    use HasFactory;
}
