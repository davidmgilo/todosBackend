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

    public function update(array $data, $iduser, $idtask)
    {
        $user = User::findOrFail($iduser);
        $task = $user->tasks()->findOrFail($idtask);
        $task->update($data);
    }

    public function delete($iduser,$idtask)
    {
        $user = User::findOrFail($iduser);
        $task = $user->tasks()->findOrFail($idtask);
        $task->delete();
    }
}
