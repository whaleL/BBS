<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function update(User $currentUser, User $user)
    {
        return $currentUser->id === $user->id;
    }

    //关注的逻辑，自己不能关注自己
     public function follow(User $currentUser, User $user)
    {
        return $currentUser->id !== $user->id;
    }
}
