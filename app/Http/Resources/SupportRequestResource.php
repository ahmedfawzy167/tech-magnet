<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SupportRequestResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request)
    {
        return [
            'problem_description' => $this->resource['problem_description'],
            'date' => $this->resource['date'],
            'user' => $this->resource['user']['name']
        ];
    }
}
