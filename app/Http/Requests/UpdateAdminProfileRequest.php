<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAdminProfileRequest extends FormRequest
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
            'name' => 'nullable|string|between:5,50',
            'email' => 'nullable|string|max:100',
            'current_password' => 'nullable|current_password',
            'new_password' => 'nullable|string|min:8|confirmed',
            'images'     => 'nullable|image|mimes:jpeg,png,jpg|max:3000',
            'phone' => 'nullable|string|max:20',
            'city_id' => 'nullable|exists:cities,id',
            'country_id' => 'nullable|exists:countries,id',
            'address' => 'nullable|string|max:255',
            'timezone' => 'nullable|string|max:100',
        ];
    }
}
