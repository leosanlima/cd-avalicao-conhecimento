<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerAddressRequest extends FormRequest
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
            'customer_id' => ['required', 'exists:customers,id'],
            'cep' => ['required', 'size:8'],
            'street' => ['required', 'max:255'],
            "city" => ['required'],
            "neighborhood" => ['required', 'max:255'],
            "state" => ['required', 'max:255'],
            "address_number" => ['required', 'max:255'],
            "complement" => ['max:255']
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'cep' => preg_replace('/\D/', '', $this->cep)
        ]);
    }
}
