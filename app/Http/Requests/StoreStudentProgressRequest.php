<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStudentProgressRequest extends FormRequest
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
            'rank' => 'required|numeric',
            'total_points' => 'required|numeric',
            'points_earned' => 'required|numeric',
            'date' => 'required|date_format:Y-m-d H:i:s|after_or_equal:now',
            'course_id' => 'required|exists:courses,id',
            'skill_id' => 'required|exists:skills,id',
        ];
    }
}
