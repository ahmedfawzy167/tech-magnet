<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PortfolioResource extends JsonResource
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
            'issue_date' => $this->resource['issue_date'],
            'user' => $this->resource['user']['name'],
            'course' => $this->resource['course']['name'],
        ];
    }
}
