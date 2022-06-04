<?php

declare(strict_types=1);

namespace App\Http\Requests\User;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UserChangeRequest extends FormRequest
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
            'name' => ['required', 'string', 'min:5'],
            'phone' => ['required', 'string'],
            'email' => ['required', 'email', Rule::unique('users','id')->ignore((int) $this->id)],
            'password' => ['nullable', 'string', 'min:6', 'confirmed'],
            'password_confirmation' => ['nullable', 'min:6'],
            'gender' => ['string'],
            'bio' => ['nullable', 'string', 'max:500'],
            'birthday' => ['nullable', 'string'],
            'сшен' => ['nullable', 'string']
        ];
    }
}
