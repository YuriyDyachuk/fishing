<?php

declare(strict_types=1);

namespace App\Http\Requests\Report;

use Illuminate\Foundation\Http\FormRequest;

class ReportUpdateRequest extends FormRequest
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
            'regionId' => ['required', 'string', 'exists:regions,id'],
            'description' => ['string'],
            'lat' => ['required', 'string'],
            'lng' => ['required', 'string']
        ];
    }

    public function messages(): array
    {
        return [
            'regionId.required' => 'Поле регион обязательно к заполнению!',
            'lat.required' => 'Поле локация обязательно к заполнению!'
        ];
    }
}