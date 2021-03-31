<?php

namespace App\Policies;

use App\Comment;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function before(User $user)
    {

    }

    public function view(User $user, Comment $comment)
    {
        return $comment->user->is($user);
    }

}
