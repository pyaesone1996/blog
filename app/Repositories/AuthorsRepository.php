<?php

namespace App\Repositories;

use App\User;

class AuthorsRepository
{
    public function aboutAuthor($name)
    {
        return User::where('username', $name)->first();
    }
}
