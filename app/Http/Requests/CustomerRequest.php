<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
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
            'cpf' => ['required', 'size:11', "unique:customers,cpf{$this->ignoresId()}"],
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'cpf' => preg_replace('/\D/', '', $this->cpf)
        ]);
    }

    /**
     * On update request returns updating model id
     * @return string
     */
    private function ignoresId(): string
    {
        if (empty($this->customer?->id)) return '';
        return ",{$this->customer->id}";
    }
}
