<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request)
    {
        return [
            'id' => $this->resource['id'],
            'name' => $this->resource['name'],
            'email' => $this->resource['email'],
            'phone' => $this->resource['phone'],
            'city' => $this->resource['city']['name'],
            'role' => $this->resource['role']['name'],
            'created_at' => $this->resource['created_at'],
            'updated_at' => $this->resource['updated_at'],
        ];
    }
}
