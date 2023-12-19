<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentRequest extends FormRequest
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
     * @return array|bool
     */
    public function rules(): array|bool
    {
        return match ($this->getMethod()) {
            'POST' => [
                'name' => 'required',
                'email' => 'required|email|unique:students,email',
                'classroom_id' => 'required|integer|exists:classrooms,id'
            ],
            'PUT' => [
                'name' => 'required',
                'classroom_id' => 'required|integer|exists:classrooms,id'
            ],
            default => false,
        };

    }
}
