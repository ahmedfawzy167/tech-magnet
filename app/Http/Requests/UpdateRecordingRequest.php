<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRecordingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:100',
            'description' => 'nullable|string|max:1000',
            'video_src' => 'nullable|file|mimes:mp4|max:2048', // Ensure the file is an MP4 and max 10MB
            'user_id' => 'required|exists:users,id', // Ensure the user exists
            'course_id' => 'required|exists:courses,id',
        ];
    }
}
