<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SupplierRequest extends FormRequest
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
            'name' => ['required', 'max:255'],
            'cnpj' => ['required', 'size:14', "unique:suppliers,cnpj{$this->ignoresId()}"],
            'company_name' => ['required', 'max:255']
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'cnpj' => preg_replace('/\D/', '', $this->cnpj)
        ]);
    }

    /**
     * On update request returns updating model id
     * @return string
     */
    private function ignoresId(): string
    {
        if (empty($this->supplier?->id)) return '';
        return ",{$this->supplier->id}";
    }
}
