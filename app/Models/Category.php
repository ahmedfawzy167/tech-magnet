<?php

namespace App\Models;

use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model implements Searchable
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name'];

    public function courses()
    {
        return $this->hasMany(Course::class);
    }

    public function getSearchResult(): SearchResult
    {
        $url = route('categories.show', $this->id);

        return new SearchResult(
            $this,
            $this->name,
            $url
        );
    }
}
