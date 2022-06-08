<?php

declare(strict_types=1);

namespace App\Http\Requests\Report;

use Illuminate\Foundation\Http\FormRequest;

class ReportRequest extends FormRequest
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
            'description' => ['required', 'string'],
            'lat' => ['required', 'string'],
            'lng' => ['required', 'string'],
            'media' => ['required', 'array'],
            'media.gallery' => ['required', 'max:20'],
            'media.gallery.*' => ['required', 'mimetypes:image/*', 'max:20480'],
            'media.video.'  => ['nullable', 'max:3'],
            'media.video.*'  => ['nullable', 'mimetypes:video/*', 'max:1024000']
        ];
    }
}