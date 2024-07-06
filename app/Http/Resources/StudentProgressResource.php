<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StudentProgressResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request)
    {
        return [
            'rank' => $this->resource['rank'],
            'total_points' => $this->resource['total_points'],
            'points_earned' => $this->resource['points_earned'],
            'date' => $this->resource['date'],
            'user' => $this->resource['user']['name'],
            'course' => $this->resource['course']['name'],
            'skill' => $this->resource['skill']['title']
        ];
    }
}
