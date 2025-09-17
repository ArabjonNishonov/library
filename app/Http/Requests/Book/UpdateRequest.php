<?php

namespace App\Http\Requests\Book;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => 'sometimes|string|max:255',
            'description' => 'nullable|string',
            'published_year' => 'nullable|integer|min:0|max:' . date('Y'),
            'status' => 'nullable|in:available,unavailable',
        ];
    }

    public function messages(): array{
        return [
            'title.string' => 'Title must be a string.',
            'title.max' => 'Title may not be greater than 255 characters.',
            'description.string' => 'Description must be a string.',
            'published_year.integer' => 'Published year must be an integer.',
            'published_year.min' => 'Published year must be at least 0.',
            'published_year.max' => 'Published year may not be greater than the current year.',
            'status.in' => 'Status must be either available or unavailable.',
        ];
    }
}
