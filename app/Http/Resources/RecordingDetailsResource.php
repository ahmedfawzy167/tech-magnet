<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RecordingDetailsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request)
    {
        return [
            'title' => $this->resource['title'],
            'description' => $this->resource['description'],
            'video_src' => $this->resource['video_src'],
            'user' => $this->resource['user']['name'],
            'course' => $this->resource['course']['name'],
        ];
    }
}
