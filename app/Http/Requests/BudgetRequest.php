<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BudgetRequest extends FormRequest
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
            'customer_id' => ['required'],
            'supplier_id' => ['required'],
            'product_id' => ['required'],
            'quantity' => ['required', 'numeric'],
            'status' => ['required'],
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'quantity' => only_numbers($this->quantity),
        ]);
    }

    public function messages(): array
    {
        return [
            'customer_id.required' => 'O campo cliente é obrigatório',
            'supplier_id.required' => 'O campo fornecedor é obrigatório',
            'product_id.required' => 'O campo produto é obrigatório',
            'status.required' => 'O campo status é obrigatório',
            'quantity.required' => 'O campo quantidade é obrigatório.',
        ];
    }


}
