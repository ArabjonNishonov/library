<?php

namespace App\Http\Requests\Rest;

use Illuminate\Foundation\Http\FormRequest;

class AddRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'due_date' => 'required|date|after:today',
            'rented_at' => 'nullable|date|after_or_equal:due_date',
        ];
    }

    public function messages(): array{
        return [
            'due_date.required' => 'Due date is required.',
            'due_date.date' => 'Due date must be a valid date.',
            'due_date.after' => 'Due date must be a future date.',
            'rented_a.date' => 'Rented at must be a valid date.',
            'rented_a.after_or_equal' => 'Rented at must be after or equal to due date.',
        ];
    }
}
