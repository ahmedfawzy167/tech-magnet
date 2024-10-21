<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProfileResource extends JsonResource
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
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'city' => $this->city->name,
            'role' => $this->role->name,
            'assignments' => AssignmentResource::collection($this->assignments()->withPivot('file', 'date')->get()),
            'quizzes' => QuizResource::collection($this->quizzes()->withPivot('score', 'date')->get()),
        ];
    }
}
