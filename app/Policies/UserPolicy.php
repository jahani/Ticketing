<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;
    use AdminAlwaysCanPolicy;

    /**
     * Determine whether the user can view the target.
     *
     * @param  \App\User  $user
     * @param  \App\User  $target
     * @return mixed
     */
    public function view(?User $user, User $target)
    {
        return true;
    }

    /**
     * Determine whether the user can create targets.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the target.
     *
     * @param  \App\User  $user
     * @param  \App\User  $target
     * @return mixed
     */
    public function update(User $user, User $target)
    {
        return $user->is($target);
    }

    /**
     * Determine whether the user can delete the target.
     *
     * @param  \App\User  $user
     * @param  \App\User  $target
     * @return mixed
     */
    public function delete(User $user, User $target)
    {
        //
    }

    /**
     * Determine whether the user can restore the target.
     *
     * @param  \App\User  $user
     * @param  \App\User  $target
     * @return mixed
     */
    public function restore(User $user, User $target)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the target.
     *
     * @param  \App\User  $user
     * @param  \App\User  $target
     * @return mixed
     */
    public function forceDelete(User $user, User $target)
    {
        //
    }
}
