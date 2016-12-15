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

    public function paginate($perPage = 15, $columns = array('*'))
    {
        return User::paginate($perPage);
    }

    public function create(array $data)
    {
        User::create($data);
    }

    public function update(array $data, $id)
    {
        User::findOrFail($id)->update($data);
    }

    public function delete($id)
    {
        User::findOrFail($id)->delete();
    }
}
