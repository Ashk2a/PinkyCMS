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
            'password' => 'required|required_with:password_repeat|same:password_repeat',
            'password_repeat' => 'required'
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
