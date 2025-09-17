<?php

namespace App\Http\Requests\Rest;

use Illuminate\Foundation\Http\FormRequest;

class ListRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'search' => 'nullable|string|max:255',
            'per_page' => 'nullable|integer|min:1|max:100',
        ];
    }

    public function messages(): array{
        return [
            'search.string' => 'Search must be a string.',
            'search.max' => 'Search may not be greater than 255 characters.',
            'per_page.integer' => 'Per page must be an integer.',
            'per_page.min' => 'Per page must be at least 1.',
            'per_page.max' => 'Per page may not be greater than 100.',
        ];
    }
}
