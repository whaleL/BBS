<?php

namespace App\Observers;

use App\Models\User;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

class UserObserver
{
    public function creating(User $user)
    {
        //
    }

    public function updating(User $user)
    {
        //
    }

    public function saving(User $user)
    {
        // 只有空的时候才指定默认头像
        if (empty($user->avatar)) {
            $user->avatar = 'https://i.loli.net/2019/03/29/5c9dc2e022f15.png';
        }
    }
}