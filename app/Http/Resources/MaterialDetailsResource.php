<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MaterialDetailsResource extends JsonResource
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
            'file' => $this->resource['file'],
            'file_type' => $this->resource['file_type'],
            'course' => $this->resource['course']['name'],
        ];
    }
}
