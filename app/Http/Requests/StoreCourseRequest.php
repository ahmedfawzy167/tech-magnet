<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCourseRequest extends FormRequest
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
            'name' => 'required|string|between:5,50',
            'description' => 'required|string|max:1000',
            'price' => ['required', 'regex:/^\d+(\.\d{1,2})?$/', 'gt:0'],
            'hours' => 'required|numeric:gt:0',
            'category_id' => 'required|exists:categories,id',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg|max:3000',
            'roadmaps' => 'required|array',
            'roadmaps.*' => 'exists:roadmaps,id'
        ];
    }
}
