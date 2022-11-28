<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FirstAccessRequest extends FormRequest
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
            // Token already validated in middleware EnsureFirstAccessTokenIsValid
            'password' => ['required', 'max:255'],
            'password_confirm' => ['same:password'],
        ];
    }
}
