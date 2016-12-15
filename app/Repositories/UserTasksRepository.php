<?php

namespace App\Repositories;

use App\Repositories\Contracts\Repository;
use App\User;

/**
 * Class UserTasksRepository.
 */
class UserTasksRepository
{
    //TODO interface
    /**
     * @param $id
     * @param array $columns
     *
     * @return mixed
     */
    public function findOrFail($id, $columns = ['*'])
    {
        // TODO: Implement findOrFail() method.
    }

    public function paginate($id, $perPage = 15, $columns = array('*'))
    {
        $user = User::findOrFail($id);

        return $user->tasks()->paginate($perPage);
    }

    public function create(array $data)
    {
        // TODO: Implement create() method.
    }

    public function update(array $data, $id)
    {
        // TODO: Implement update() method.
    }

    public function delete($id)
    {
        // TODO: Implement delete() method.
    }
}
