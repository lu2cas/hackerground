<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['string', 'min:8', 'confirmed'],
            'bio' => ['nullable', 'string', 'max:255'],
            'website' => ['nullable', 'url', 'max:255']
            // @todo Validate uploaded image and its MIME type
            // 'avatar_path' => ['nullable', 'image'],
        ];
    }
}
