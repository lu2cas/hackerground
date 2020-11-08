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
            'activity' => ['required', Rule::in(['MEETING', 'WORKSHOP', 'TALK', 'HACKATON', 'CTF', 'CODING_DOJO'])],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date'],
            'summary' => ['nullable', 'string']
        ];
    }
}
