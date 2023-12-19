<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClassroomRequest extends FormRequest
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
    public function rules(): array|bool
    {
        return match ($this->getMethod()) {
            'POST' => [
                'name' => 'required|unique:classrooms,name',
            ],
            'PUT' => [
                'lectures' => 'required|array',
                'lectures.*.id' => 'required|exists:lectures,id',
                'lectures.*.order' => 'required|integer',
            ],
            default => false,
        };

    }

    protected function prepareForValidation()
    {
        $decodedData = json_decode($this->input('lectures'), true);

        if (is_array($decodedData)) {
            $this->merge(['lectures' => $decodedData['lectures']]); // Обратите внимание на ['lectures']
        }
    }
}
