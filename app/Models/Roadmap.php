<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Roadmap extends Model
{
    protected $fillable = ['title','description'];

    public function courses()
    {
        return $this->belongsToMany(Course::class);
    }

    use HasFactory;
}
