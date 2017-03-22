<?php

namespace Davidmgilo\TodosBackend\Policies;

use Davidmgilo\TodosBackend\User;
use Davidmgilo\TodosBackend\Task;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * Class TaskPolicy
 * @package Davidmgilo\TodosBackend\Policies
 */
class TaskPolicy extends BasePolicy
{
    use HandlesAuthorization,HasAdmin;

    /**
     * @return string
     */
    protected function model()
    {
        return 'task';
    }
}
