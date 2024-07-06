<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $fillable =['title','description'];

    public function image()
    {
        return $this->morphOne(Image::class,'imageable');
    }
    
    use HasFactory;
}
