<?php

namespace Davidmgilo\TodosBackend\Policies;

use Davidmgilo\TodosBackend\User;
use Davidmgilo\TodosBackend\Task;
use Illuminate\Auth\Access\HandlesAuthorization;


class BasePolicy
{
    use HandlesAuthorization,HasAdmin;

    /**
     * Determine whether the user can list things.
     *
     * @param  \Davidmgilo\TodosBackend\User  $user
     * @return mixed
     */
    public function show(User $user)
    {
        if ($user->hasPermissionTo('show-'. $this->model())) return true;
        return false;
    }

    /**
     * Determine whether the user can view things.
     *
     * @param  \Davidmgilo\TodosBackend\User  $user
     * @param  \Davidmgilo\TodosBackend\Task  $task
     * @return mixed
     */
    public function view(User $user, Task $task)
    {
        if ($user->hasPermissionTo('view-' . $this->model())) return true;
        return false;
    }

    /**
     * Determine whether the user can create things.
     *
     * @param  \Davidmgilo\TodosBackend\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        if ($user->hasPermissionTo('create-' . $this->model())) return true;
        return false;
    }

    /**
     * Determine whether the user can update things.
     *
     * @param  \Davidmgilo\TodosBackend\User  $user
     * @param  \Davidmgilo\TodosBackend\Task  $task
     * @return mixed
     */
    public function update(User $user, Task $task)
    {
        if ($user->hasPermissionTo('update-' . $this->model())) return true;
        return false;
    }

    /**
     * Determine whether the user can delete things.
     *
     * @param  \Davidmgilo\TodosBackend\User  $user
     * @param  \Davidmgilo\TodosBackend\Task  $task
     * @return mixed
     */
    public function delete(User $user, Task $task)
    {
        if ($user->hasPermissionTo('delete-' . $this->model())) return true;
        return false;
    }

}
