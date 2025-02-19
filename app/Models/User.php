<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Laratrust\Contracts\LaratrustUser;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Laratrust\Traits\HasRolesAndPermissions;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements JWTSubject , LaratrustUser
{
    use HasApiTokens, HasFactory, Notifiable, HasRolesAndPermissions;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'status',
        'social_id',
        'social_type'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function addresses()
    {
        return $this->hasMany(Address::class);
    }


    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    
    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    public function portfolios()
    {
        return $this->hasMany(Portfolio::class);
    }

    public function supportRequests()
    {
        return $this->hasMany(SupportRequest::class);
    }

    public function recordings()
    {
        return $this->hasMany(Recording::class);
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    public function sessions()
    {
        return $this->hasMany(Session::class);
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'course_user')->withPivot('date');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function assignments()
    {
        return $this->belongsToMany(Assignment::class, 'assignment_user')->withPivot('file', 'date');
    }

    public function quizzes()
    {
        return $this->belongsToMany(Quiz::class, 'quiz_user')->withPivot('score', 'date');
    }

    public function studentProgress()
    {
        return $this->hasMany(StudentProgress::class);
    }

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    public function wishlists()
    {
        return $this->hasMany(Wishlist::class);
    }

    public function isBlocked()
    {
        if ($this->is_blocked) {
            if ($this->blocked_until && now()->isPast($this->blocked_until)) {
                $this->is_blocked = false;
                $this->blocked_until = null;
                $this->save();
            }
            return true;
        }
        return false;
    }

    public function blockUser($duration = null, $unit = 'minutes')
    {
         $this->is_blocked = true;

         if ($duration) {
            if ($unit === 'days') {
                $this->blocked_until = now()->addDays($duration);
            } else {
            $this->blocked_until = now()->addMinutes($duration);
        }
    }

    $this->save();
}
    public function unblockUser()
    {
        $this->is_blocked = false;
        $this->blocked_until = null;
        $this->save();
    }


}
