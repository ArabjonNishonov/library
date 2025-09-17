<?php

namespace App\Http\Requests\Book;

use Illuminate\Foundation\Http\FormRequest;

class AddRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'pdf' => 'nullable|file|mimes:pdf|max:20480', // max 20MB
            'date' => 'nullable|date',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Title is required.',
            'title.string' => 'Title must be a string.',
            'title.max' => 'Title may not be greater than 255 characters.',
            'description.string' => 'Description must be a string.',
        ];
    }
}
