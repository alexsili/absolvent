<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;

class StudentsRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [
            'name' => 'required|string|max:255',
            'school_class_id' => 'required|exists:school_classes,id',
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

    public function getStudentsData(): array
    {
        return [
            'name' => $this->get('name'),
            'school_class_id' => $this->get('school_class_id'),
        ];
    }
}
