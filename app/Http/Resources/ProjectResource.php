<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request)
    {
        return [
           'file' => $this->resource['file'],
           'status' => $this->resource['status'],
            'user' => $this->resource['user']['name']
        ];
    }
}
