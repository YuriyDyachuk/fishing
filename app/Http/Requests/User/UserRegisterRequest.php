<?php

declare(strict_types=1);

namespace App\Http\Requests\User;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UserRegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:3', 'max:50'],
            'email' => ['required', 'email'],
            'phone' => ['required', 'string', Rule::unique('users','phone')],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'password_confirmation' => ['required','min:6']
        ];
    }
}
