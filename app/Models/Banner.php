<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;

    protected $fillable = ['name'];
    
    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    public function locations()
    {
        return $this->belongsToMany(Location::class, 'banner_location', 'banner_id', 'location_id');
    }
}
