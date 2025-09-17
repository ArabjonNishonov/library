<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'login' => 'required|email',
            'password' => 'required|string|min:6',
            'c_password' => 'required|string|min:6|same:password',
        ];
    }

    public function messages(): array{
        return [
            'login.required' => 'The login field is required.',
            'login.email' => 'The login must be a email.',
            'password.string' => 'The password must be a string.',
            'c_password.string' => 'The password confirmation must be a string.',
            'c_password.same' => 'The password confirmation does not match.',
            'password.required' => 'The password field is required.',
            'password.min' => 'The password must be at least 6 characters.',
            'c_password.required' => 'The password confirmation field is required.',
            'c_password.min' => 'The password confirmation must be at least 6 characters.',
        ];
    }
}
