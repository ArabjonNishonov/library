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
            'page_count' => 'nullable|integer|min:1',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Title is required.',
            'title.string' => 'Title must be a string.',
            'title.max' => 'Title may not be greater than 255 characters.',
            'description.string' => 'Description must be a string.',
            'pdf.file' => 'PDF must be a file.',
            'pdf.mimes' => 'PDF must be a file of type: pdf.',
            'pdf.max' => 'PDF may not be greater than 20MB.',
            'date.date' => 'Date must be a valid date.',
            'page_count.integer' => 'Page count must be an integer.',
            'page_count.min' => 'Page count must be at least 1.',
        ];
    }
}
