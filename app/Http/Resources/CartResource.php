<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CartResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'courseName' => $this->course->name,
            'courseDescription' => $this->course->description,
            'coursePrice' => $this->course->price,
            'courseHours' => $this->course->hours,
            'CourseImage' => $this->course->image ? asset('storage/' . $this->course->image->path) : null,
            'user' => $this->user->name,
        ];
    }
}
