<?php

namespace App\Repositories;

use App\Repositories\Contracts\Repository;
use App\User;

/**
 * Class UserRepository.
 */
class UserRepository implements Repository
{
    /**
     * @param int   $id
     * @param array $columns
     *
     * @return mixed
     */
    public function findOrFail($id, $columns = ['*'])
    {
        return User::findOrFail($id);
    }
}
