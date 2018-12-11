<?php

namespace App\Policies;

use App\User;

trait AdminAlwaysCanPolicy
{
    public function before($user, $ability)
    {
        if ($user->isAdmin()) {
            return true;
        }
    }
}
