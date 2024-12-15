<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SessionResource extends JsonResource
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
            'topic' => $this->topic,
            'description' => $this->description,
            'start_date' => $this->start_date,
            'user' => $this->user->name,
            'course' => $this->course->name,
            'meeting_id' => $this->meeting_id,
            'start_url' => $this->start_url,
            'join_url' => $this->join_url,
        ];
    }
}
