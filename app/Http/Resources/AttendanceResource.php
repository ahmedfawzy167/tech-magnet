<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AttendanceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request):array
    {
        return [
            'user' => $this->user->name,
            'course' => $this->course->name,
            'date' => $this->date,
            'status' => $this->attendance_status
        ];
    }
}
