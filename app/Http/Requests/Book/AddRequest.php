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
            'published_year' => 'required|integer|min:1000|max:' . date('Y'),
            'page_count' => 'required|integer|min:1',
            'pdf' => 'nullable|file|mimes:pdf|max:20480', // max 20MB
            'status' => 'nullable|boolean|in:available,unavailable',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Title is required.',
            'title.string' => 'Title must be a string.',
            'title.max' => 'Title may not be greater than 255 characters.',
            'description.string' => 'Description must be a string.',
            'published_year.required' => 'Published year is required.',
            'published_year.integer' => 'Published year must be an integer.',
            'published_year.min' => 'Published year must be at least 1000.',
            'published_year.max' => 'Published year may not be greater than the current year.',
            'page_count.required' => 'Page count is required.',
            'page_count.integer' => 'Page count must be an integer.',
            'page_count.min' => 'Page count must be at least 1.',
            'pdf.file' => 'PDF must be a file.',
            'pdf.mimes' => 'PDF must be a file of type: pdf.',
            'pdf.max' => 'PDF may not be greater than 20MB.',
            'status.boolean' => 'Status must be true or false.',
            'status.in' => 'Status must be either available or unavailable.',
        ];
    }
}
