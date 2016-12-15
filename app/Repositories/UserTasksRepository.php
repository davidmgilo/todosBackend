<?php

namespace App\Repositories;

use App\Repositories\Contracts\Repository;
use App\User;

/**
 * Class UserTasksRepository.
 */
class UserTasksRepository implements Repository
{

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

    public function paginate($perPage = 15, $columns = array('*'))
    {
        // TODO: Implement paginate() method.
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
