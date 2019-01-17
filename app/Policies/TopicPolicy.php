<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Topic;

class TopicPolicy extends Policy
{
    public function update(User $user, Topic $topic)
    {
         return $topic->user_id == $user->id;//控制修改权限
        //return true;
    }

    public function destroy(User $user, Topic $topic)
    {
        //return true;
        return $topic->user_id == $user->id;
    }
}
