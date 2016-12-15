<?php

namespace App\Repositories;


use App\Task;
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
    public function findOrFail($iduser,$idtask, $columns = ['*'])
    {
        $user = User::findOrFail($iduser);
        return $user->tasks()->findOrFail($idtask);
    }

    public function paginate($id, $perPage = 15, $columns = array('*'))
    {
        $user = User::findOrFail($id);

        return $user->tasks()->paginate($perPage);
    }

    public function create(array $data, $id)
    {
        User::findOrFail($id);
        Task::create($data);
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
