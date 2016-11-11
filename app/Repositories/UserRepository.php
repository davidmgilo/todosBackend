<?php

namespace App\Respositories;

use App\Respositories\Contracts\Repository;
use App\User;

class UserRepository implements Repository
{

    public function find($id, $columns = array('*'))
    {
        return User::findOrFail($id);
    }
}