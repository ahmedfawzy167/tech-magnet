<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SettingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request)
    {
        return [
            'logo' => asset('storage/' . $this->logo),
            'email' => $this->email,
            'phone' => $this->phone,
            'location' => $this->location,
        ];
    }
}
