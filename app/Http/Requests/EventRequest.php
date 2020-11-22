<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EventRequest extends FormRequest
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
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'type' => ['required', Rule::in(['ONLINE', 'IN_PERSON'])],
            'url' => ['nullable', 'url', 'max:255'],
            'activity' => ['required', Rule::in(['MEETING', 'WORKSHOP', 'TALK', 'HACKATON', 'CTF', 'CODING_DOJO', 'OTHER'])],
            'starts_at' => ['required', 'date_format:Y-m-d'],
            'ends_at' => ['required', 'date_format:Y-m-d'],
            'summary' => ['nullable', 'string']
        ];
    }
}
