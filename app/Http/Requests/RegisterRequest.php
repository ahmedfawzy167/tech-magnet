<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rules\Password;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'name' => ['required', 'string', 'between:2,50'],
            'email' => ['required', 'string', 'email', 'unique:users', 'max:50'],
            'password' => ['required', Password::defaults(), 'confirmed'],
            'phone' => 'required|string|max:11',
            'city' => 'required|exists:cities,id',
            'role' => 'required|exists:roles,id',
        ];
    }
}
