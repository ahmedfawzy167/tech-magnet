<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSessionRequest extends FormRequest
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
            'topic' => 'required|string|between:2,50',
            'description' => 'required|max:500',
            'start_date' => 'required|date_format:Y-m-d H:i:s|after_or_equal:now',
            'course_id' => 'required|exists:courses,id',
        ];
    }
}
