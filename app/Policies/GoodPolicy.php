<?php

namespace App\Policies;

use App\Models\Good;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class GoodPolicy
{
    use HandlesAuthorization;

    /**
     * @param User $user
     * @return bool
     */
    public function create(User $user)
    {
        return $user !== null;
    }

    /**
     * @param User $user
     * @param Good $good
     * @return bool
     */
    public function update(User $user, Good $good)
    {
        return $user->is_admin || $good->user_id == $user->id;
    }

    /**
     * @param User $user
     * @param Good $good
     * @return bool
     */
    public function delete(User $user, Good $good)
    {
        return $user->is_admin || $good->user_id == $user->id;
    }
}
