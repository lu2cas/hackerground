<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class HackerspaceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'geolocation' => ['nullable', 'string'],
            // @todo Validate uploaded image and its MIME type
            // 'logo_path' => ['nullable', 'image'],
            'founded_on' => ['required', 'date_format:Y-m-d'],
            'status' => ['required', Rule::in(['ACTIVE', 'INACTIVE', 'PLANNED'])],
            'website' => ['nullable', 'url'],
            'email' => ['required', 'email', Rule::unique('hackerspaces', 'email')->ignore($this->hackerspace)]
        ];
    }
}
