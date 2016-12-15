<?php

namespace App\Repositories;

use App\Repositories\Contracts\Repository;
use App\Task;

/**
 * Class TaskRepository.
 */
class TaskRepository implements Repository
{
    /**
     * @param int   $id
     * @param array $columns
     *
     * @return mixed
     */
    public function findOrFail($id, $columns = ['*'])
    {
        return Task::findOrFail($id);
    }

    public function paginate($perPage = 15, $columns = array('*'))
    {
        return Task::paginate($perPage);
    }

    public function create(array $data)
    {
        Task::create($data);
    }

    public function update(array $data, $id)
    {
        Task::findOrFail($id)->update($data);
    }

    public function delete($id)
    {
        Task::findOrFail($id)->delete();
    }
}
