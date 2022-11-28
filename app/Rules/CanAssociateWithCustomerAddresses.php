<?php

namespace App\Rules;

use App\Models\Role;
use App\Models\User;
use Illuminate\Contracts\Validation\Rule;

class CanAssociateWithCustomerAddresses implements Rule
{
    private string $message = 'Não é possível associar o usuário com os endereços selecionados';
    /**
     * Create a new rule instance.
     *
     * @param User $user
     * @param array $customerAddresses
     */
    public function __construct(private User $user) {}

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param array $customerAddressesIds
     * @return bool
     * @throws \Exception
     */
    public function passes($attribute, $customerAddressesIds)
    {
        if (!$this->user->isCustomerEmployee()) {
            $this->message = 'Somente é permitido associar endereços de clientes a usuários com função funcionário do cliente.';
            return false;
        }

        $canBeAssociateToOnlyOneCustomerAddress = in_array(
            $this->user->role->identifier,
            Role::ALLOWED_ONLY_WITH_ONE_CUSTOMER_ADDRESS_ROLES_IDENTIFIER
        );

        if ($canBeAssociateToOnlyOneCustomerAddress && count($customerAddressesIds) > 1) {
            $this->message = 'Funcionários do cliente do tipo inspetor ou diretor só podem estar associados a 1 endereço do cliente.';
            return false;
        }

        return true;
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
