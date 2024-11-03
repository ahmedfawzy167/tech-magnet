<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bundle extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'description', 'price'];

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'bundle_course', 'bundle_id', 'course_id');
    }

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }
}
