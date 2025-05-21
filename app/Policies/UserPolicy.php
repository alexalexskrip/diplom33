<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Определить, может ли пользователь просматривать список пользователей.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasRole('admin');
    }

    /**
     * Определить, может ли пользователь создать нового пользователя.
     */
    public function create(User $user): bool
    {
        return $user->hasRole('admin');
    }

    /**
     * Определить, может ли пользователь редактировать другого пользователя.
     */
    public function update(User $user, User $model): bool
    {
        return $user->hasRole('admin');
    }

    /**
     * Определить, может ли пользователь удалить другого пользователя.
     */
    public function delete(User $user, User $model): bool
    {
        return $user->hasRole('admin');
    }
}
