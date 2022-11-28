<?php

namespace App\Http\Requests\User;

use App\Models\Role;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserStoreRequest extends FormRequest
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
     * @throws \Exception
     */
    public function rules(): array
    {
        $customerEmployeeRoleIds = Role::getCustomerEmployeeRoles()
            ->map(fn(Role $role) => $role->id)
            ->join(',');

        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($this?->user?->id)],
            'cpf' => ['required', 'max:11', Rule::unique('users')->ignore($this?->user?->id)->whereNull('deleted_at')],
            'role_id' => ['required', 'exists:roles,id'],
            'password' => ['nullable', 'string', 'max:255'],
            'cep' => ['required', 'size:8'],
            'street' => ['required', 'max:255'],
            'city' => ['required'],
            'neighborhood' => ['required', 'max:255'],
            'state' => ['required', 'max:255'],
            'address_number' => ['required', 'max:255'],
            'complement' => ['nullable', 'string', 'max:255'],
            'customer_address_id' => ["required_if:role_id,$customerEmployeeRoleIds", 'exists:customer_addresses,id']
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'cep' => preg_replace('/\D/', '', $this->cep),
            'cpf' => preg_replace('/\D/', '', $this->cpf)
        ]);
    }
}
