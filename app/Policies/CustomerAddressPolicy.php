<?php

namespace App\Policies;

use App\Models\CustomerAddress;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class CustomerAddressPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param User $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param User $user
     * @return bool
     */
    public function view(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param User $user
     * @return Response
     */
    public function create(User $user): Response
    {
        return $user->isAdministrator()
            ? $this->allow()
            : $this->deny('Você não possui permissão para criar um Endereço de Cliente');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @return Response
     */
    public function update(User $user, CustomerAddress $customerAddress): Response
    {
        if ($user->isAdministrator()) {
            return $this->allow();
        }

        if ($user->isCustomerEmployee() && $user->customer(true)->id === $customerAddress->customer_id) {
            return $this->allow();
        }

        return $this->deny('Você não possui permissão para editar um Endereço de Cliente');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @return Response
     */
    public function delete(User $user): Response
    {
        return $user->isAdministrator()
            ? $this->allow()
            : $this->deny('Você não possui permissão para remover um Endereço de Cliente');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param User $user
     * @return bool
     */
    public function restore(User $user): bool
    {
        return $user->isAdministrator()
            ? $this->allow()
            : $this->deny('Você não possui permissão para restaurar um Endereço de Cliente');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param User $user
     * @return Response
     */
    public function forceDelete(User $user): Response
    {
        return $user->isAdministrator()
            ? $this->allow()
            : $this->deny('Você não possui permissão para remover um Endereço de Cliente');
    }
}
