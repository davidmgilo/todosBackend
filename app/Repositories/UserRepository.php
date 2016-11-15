<?php

namespace App\Repositories;

use App\Repositories\Contracts\Repository;
use App\User;

/**
 * Class UserRepository
 * @package App\Repositories
 */
class UserRepository implements Repository
{

    /**
     * @param $id
     * @param array $columns
     * @return mixed
     */
    public function find($id, $columns = array('*'))
    {
        return User::findOrFail($id);
    }
}