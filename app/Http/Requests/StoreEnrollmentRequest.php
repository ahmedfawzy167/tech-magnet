<?php

namespace App\Http\Requests;

use App\Traits\ApiResponder;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;


class StoreEnrollmentRequest extends FormRequest
{
    use ApiResponder;
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
            'course' => 'required|exists:courses,id',
            'date' => 'nullable|date|after_or_equal:today',
        ];
    }

    public function messages()
    {
        return [
            'course.required' => 'Course is Required.',
            'course.exists' => 'The Selected Course Does not Exist.',
            'date.date' => 'The Date must be a Valid Date Format.',
            'date.after_or_equal' => 'The date cannot be in the past.',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $errors = $validator->errors()->toArray();
        throw new HttpResponseException(
            $this->validationError($errors)
        );
    }
}
