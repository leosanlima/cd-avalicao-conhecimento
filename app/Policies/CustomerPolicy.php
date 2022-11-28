<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class CustomerPolicy
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
        return $user->isAdministrator() || $user->isTechnician();
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
            : $this->deny('Você não possui permissão para criar um Cliente');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @return Response
     */
    public function update(User $user): Response
    {
        return $user->isAdministrator()
            ? $this->allow()
            : $this->deny('Você não possui permissão para editar um Cliente');
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
            : $this->deny('Você não possui permissão para remover um Cliente');
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
            : $this->deny('Você não possui permissão para restaurar um Cliente');
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
            : $this->deny('Você não possui permissão para remover um Cliente');
    }
}
