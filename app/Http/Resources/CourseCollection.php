<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CourseCollection extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request)
    {
        $courses = $this->resource->items();

        return [
            'status' => "Success",
            'count' => $this->count(),
            'courses' => array_map(function ($course) {
                return [
                    'image' => $course->image ? asset('storage/' . $course->image->path) : null,
                    'id' => $course->id,
                    'name' => $course->name,
                    'description' => $course->description,
                    'price' => $course->price,
                    'hours' => $course->hours,
                    'category' => $course->category->name,
                    'objective' => $course->objective->name,
                ];
            }, $courses),
            'pagination' => [
                'total' => $this->resource->total(),
                'per_page' => $this->resource->perPage(),
                'current_page' => $this->resource->currentPage(),
                'last_page' => $this->resource->lastPage(),
                'next_page_url' => $this->resource->nextPageUrl(),
                'prev_page_url' => $this->resource->previousPageUrl(),
            ],

        ];
    }
}
