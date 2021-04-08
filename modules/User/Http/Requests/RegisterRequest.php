<?php

namespace Modules\User\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

class RegisterRequest extends FormRequest
{
    public function rules(): array {
        return [
            'email' => 'required|unique:users,email',
            'username' => 'required|unique:users,username',
            'password' => 'required|required_with:repeated_password|same:repeated_password',
            'repeated_password' => 'required'
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
