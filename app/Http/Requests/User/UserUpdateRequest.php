<?php

namespace App\Http\Requests\User;

use App\Models\User;
use App\Rules\AvailableRole;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UserUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        if (!empty($this->password)) {
            /** @var User $user */
            $user = Auth::user();
            return $user->id == $this->user->id || $user->isAdministrator();
        }

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
        return [
            'name' => ['required', 'string', 'max:255'],
            'cpf' => ['required', 'max:11', Rule::unique('users')->ignore($this?->user?->id)],
            'role_id' => ['required', new AvailableRole($this->user)],
            'password' => ['nullable', 'string', 'max:255'],
            'password_confirm' => ['required_with:password', 'same:password'],
            'cep' => ['required', 'size:8'],
            'street' => ['required', 'max:255'],
            'city' => ['required'],
            'neighborhood' => ['required', 'max:255'],
            'state' => ['required', 'max:255'],
            'address_number' => ['required', 'max:255'],
            'complement' => ['nullable', 'string', 'max:255'],
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
