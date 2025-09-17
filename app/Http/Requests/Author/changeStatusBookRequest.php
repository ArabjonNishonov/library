<?php

namespace App\Http\Requests\Author;

use Illuminate\Foundation\Http\FormRequest;

class changeStatusBookRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'status' => 'required|boolean|in:available,unavailable',
        ];
    }
}
