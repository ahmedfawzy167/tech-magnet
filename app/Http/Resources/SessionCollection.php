<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SessionCollection extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request)
    {
        return [
            'topic' => $this->resource['topic'],
            'description' => $this->resource['description'],
            'start_date' => $this->resource['start_date'],
            'user' => $this->resource['user']['name'],
            'course' => $this->resource['course']['name'],
            'meeting_id' => $this->resource['meeting_id'],
            'join_url' => $this->resource['join_url'],
        ];
    }
}
