<?php

namespace App\Rules;

use App\Models\Role;
use App\Models\User;
use Illuminate\Contracts\Validation\Rule;

class AvailableRole implements Rule
{
    private string $message = 'A função selecionada não está diponível para esse usuário';
    /**
     * @param User $user
     */
    public function __construct(private User $user) {}

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        try {
            $roles = Role::getRolesAvailableToChanges($this->user);
            return $roles->contains(fn(Role $role) => $role->id === (int) $value);
        } catch (\Exception) {
            $this->message = 'Ocorreu um erro ao verificar a disponibilidade da função.';
            return false;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return $this->message;
    }
}
