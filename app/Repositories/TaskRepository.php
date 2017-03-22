<?php

namespace Davidmgilo\TodosBackend\Repositories;

use Davidmgilo\TodosBackend\Repositories\Contracts\Repository;
use Davidmgilo\TodosBackend\Task;

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
        $task = $this->findOrFail($id);
        $task->update($data);
    }

    public function delete($id)
    {
        $task = $this->findOrFail($id);
        $task->delete();
    }
}
