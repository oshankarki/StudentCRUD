<?php

namespace App\Http\Requests;

use App\Models\Student;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StudentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        $rules = [
            "name" => 'required',
            "phone" => 'required|regex:/^[0-9]{10}$/|numeric',
            "address" => 'required',
            "start_date" => 'required',
            "end_date" => 'required',
            "level" => 'required',
            "university" => 'required',
            "college" => 'required',
            "email" => 'required|unique:students,email'
        ];

        if ($this->isMethod('put') || $this->isMethod('patch')) {
            $rules['email'] = [
                'email',
                Rule::unique('students')->ignore($this->route('id')),
            ];
        }

        return $rules;
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'email.unique' => 'This email already exists.',
            'phone.regex' => 'Please enter a valid phone number.'
        ];
    }
}
