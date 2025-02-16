<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    protected $fillable = ['name'];
    
    public function banners()
    {
        return $this->belongsToMany(Banner::class, 'banner_location', 'banner_id', 'location_id');
    }
}
