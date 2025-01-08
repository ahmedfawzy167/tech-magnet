<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BlogCollection extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'blogs' => [
                'title' => $this->title,
                'description' => $this->description,
                'image' => $this->image ? asset('storage/blogs/' . $this->id . '/' . $this->image->path) : null,
            ]
        ];
    }
}
