<?php

namespace App\Http\Requests\Rest;

use Illuminate\Foundation\Http\FormRequest;

class ListRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'search' => 'nullable|string|max:255',
        ];
    }

    public function messages(): array{
        return [
            'search.string' => 'Search must be a string.',
            'search.max' => 'Search may not be greater than 255 characters.',
        ];
    }
}
