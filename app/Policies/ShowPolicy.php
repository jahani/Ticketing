<?php

namespace App\Policies;

use App\User;
use App\Show;
use Illuminate\Auth\Access\HandlesAuthorization;

class ShowPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the show.
     *
     * @param  \App\User  $user
     * @param  \App\Show  $show
     * @return mixed
     */
    public function view(?User $user, Show $show)
    {
        return ($user ?? new User)->can('view', $show->event);
    }

    /**
     * Determine whether the user can create shows.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the show.
     *
     * @param  \App\User  $user
     * @param  \App\Show  $show
     * @return mixed
     */
    public function update(User $user, Show $show)
    {
        return $user->can('update', $show->event);
    }

    /**
     * Determine whether the user can delete the show.
     *
     * @param  \App\User  $user
     * @param  \App\Show  $show
     * @return mixed
     */
    public function delete(User $user, Show $show)
    {
        return $user->can('update', $show->event);
    }

    /**
     * Determine whether the user can restore the show.
     *
     * @param  \App\User  $user
     * @param  \App\Show  $show
     * @return mixed
     */
    public function restore(User $user, Show $show)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the show.
     *
     * @param  \App\User  $user
     * @param  \App\Show  $show
     * @return mixed
     */
    public function forceDelete(User $user, Show $show)
    {
        //
    }
}
