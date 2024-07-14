<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rules\Password;
use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'name' => 'required|string|between:2,50',
            'email' => 'required|email|string|unique:users|max:50',
            'password' => ['required', Password::defaults()],
            'phone' => 'required|string|max:11',
            'city_id' => 'required|numeric|gt:0',
            'role_id' => 'required|numeric|gt:0',
        ];
    }

    public function attributes(): array
    {
        return [
            'email' => 'Email address',
        ];
    }
}
