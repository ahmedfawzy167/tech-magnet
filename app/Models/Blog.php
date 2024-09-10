<?php

namespace App\Models;

use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Blog extends Model implements Searchable
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['title', 'description'];

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    public function getSearchResult(): SearchResult
    {
        $url = route('blogs.show', $this->id);

        return new SearchResult(
            $this,
            $this->title,
            $url
        );
    }
}
