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
     * @param $id
     * @param array $columns
     *
     * @return mixed
     */
    public function find($id, $columns = ['*'])
    {
        return Task::findOrFail($id);
    }
}
