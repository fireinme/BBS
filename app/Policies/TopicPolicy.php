<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Topic;

class TopicPolicy extends Policy
{
    public function create(User $user)
    {
        return $user;
    }

    public function update(User $user, Topic $topic)
    {
        return $user == $topic->user;
    }
}
