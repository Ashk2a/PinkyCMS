<?php

namespace Modules\User\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

class LoginRequest extends FormRequest
{
    #[ArrayShape(['email' => "string", 'password' => "string"])] public function rules(): array {
        return [
            'email' => 'required',
            'password' => 'required'
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
