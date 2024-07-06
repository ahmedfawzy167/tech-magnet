<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupportRequest extends Model
{
    protected $table = 'support_requests';

    protected $fillable = ['problem_description','date','status','user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    use HasFactory;
}
