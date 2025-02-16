<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use App\Http\Resources\LocationResource;
use Illuminate\Http\Resources\Json\JsonResource;

class BannerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'image'  =>  $this->image ? asset('storage/banners/' . $this->id . '/' . $this->image->path) : null,
            'id' => $this->id,
            'name' => $this->name,
            'locations' => LocationResource::collection($this->locations),
        ];
    }
}
