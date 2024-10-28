<?php

namespace App\Observers;

use App\Models\Category;
use Illuminate\Support\Facades\Log;

class CategoryObserver
{
    /**
     * Handle the Category "created" event.
     */
    public function created(Category $category): void
    {
        Log::info('Category Created! ' . $category->name);
    }

    /**
     * Handle the Category "updated" event.
     */
    public function updated(Category $category): void
    {
        Log::info('Category Updated! ' . $category->name);
    }

    /**
     * Handle the Category "deleted" event.
     */
    public function deleted(Category $category): void
    {
        Log::info('Category Deleted! ' . $category->name);
    }

    /**
     * Handle the Category "restored" event.
     */
    public function restored(Category $category): void
    {
        Log::info('Category Restored! ' . $category->name);
    }

    /**
     * Handle the Category "force deleted" event.
     */
    public function forceDeleted(Category $category): void
    {
        Log::info('Category Deleted Permenantly! ' . $category->name);
    }
}
