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

    public function messages(): array
    {
        return [
            'description.required' => 'Поле описание обязательно к заполнению!',
            'lat.required' => 'Поле локация обязательно к заполнению!',
            'media.gallery.max' => 'Выберите фото в количестве 20 штук.',
            'media.gallery.*.size' => 'Выберите фото размером до 20MB!',
            'media.video.max'  => 'Выберите видео в количестве 3 штук.',
            'media.video.*.size'  => 'Выберите видео размеров до 1GB!'
        ];
    }
}