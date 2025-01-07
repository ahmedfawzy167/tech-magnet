<?php

namespace App\Models;

use App\Enums\CourseStatus;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model implements Searchable
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'description', 'price', 'hours', 'category_id', 'status'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }


    public function quizzes()
    {
        return $this->hasMany(Quiz::class);
    }

    public function assignments()
    {
        return $this->hasMany(Assignment::class);
    }

    public function portfolios()
    {
        return $this->hasMany(Portfolio::class);
    }


    public function superskills()
    {
        return $this->hasMany(SuperSkill::class);
    }

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }

    public function roadmaps()
    {
        return $this->belongsToMany(Roadmap::class);
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    public function sessions()
    {
        return $this->hasMany(Session::class);
    }


    public function users()
    {
        return $this->belongsToMany(User::class, 'course_user')->withPivot('date');
    }

    public function studentProgress()
    {
        return $this->hasMany(StudentProgress::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function bundles()
    {
        return $this->belongsToMany(Bundle::class, 'bundle_course', 'bundle_id', 'course_id');
    }

    public function discounts()
    {
        return $this->belongsToMany(Discount::class, 'course_discount', 'course_id', 'discount_id');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    public function wishlists()
    {
        return $this->hasMany(Wishlist::class);
    }

    public function getSearchResult(): SearchResult
    {
        $url = route('courses.show', $this->id);

        return new SearchResult(
            $this,
            $this->name,
            $url
        );
    }

    protected $casts = [
        'status' => CourseStatus::class,
    ];
}
