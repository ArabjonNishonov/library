<?php

namespace App\Http\Requests\Rest;

use Illuminate\Foundation\Http\FormRequest;

class AddRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'due_date' => 'required|date|after:today',
        ];
    }

    public function messages(): array{
        return [
            'due_date.required' => 'Due date is required.',
            'due_date.date' => 'Due date must be a valid date.',
            'due_date.after' => 'Due date must be a future date.',
        ];
    }
}
