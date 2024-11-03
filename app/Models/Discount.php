<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasFactory;

    protected $fillable = ['code', 'amount', 'percentage', 'expiry_date', 'is_active'];

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'course_discount', 'discount_id', 'course_id');
    }
}
