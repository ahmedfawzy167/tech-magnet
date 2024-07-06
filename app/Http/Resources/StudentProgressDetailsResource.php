<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StudentProgressDetailsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'rank' => $this->rank,
            'total_points' => $this->total_points,
            'points_earned' => $this->points_earned,
            'date' => $this->points_earned,
            'user' => $this->user->name,
            'course' => $this->course->name,
            'skill' => $this->skill->title
        ];;
    }
}
