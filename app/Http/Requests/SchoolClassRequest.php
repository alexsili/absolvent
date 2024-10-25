<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;

class SchoolClassRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [
            'name' => 'required|string|max:255',
            'teacher_id' => 'required|exists:users,id',
        ];

        return $rules;
    }

    public function failedValidation(Validator $validator)
    {

        if ($this->expectsJson()) {
            throw new HttpResponseException(response()->json([
                'success' => false,
                'message' => 'Validation errors',
                'data' => $validator->errors()
            ], 400));
        }

        throw new ValidationException($validator, redirect()->back()
            ->withInput()
            ->withErrors($validator));

    }

    public function getSchoolClassData(): array
    {
        return [
            'name' => $this->get('name'),
            'teacher_id' => $this->get('teacher_id'),
        ];
    }
}
