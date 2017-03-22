<?php

namespace Davidmgilo\TodosBackend\Policies;

use Davidmgilo\TodosBackend\User;
use Davidmgilo\TodosBackend\Task;
use Illuminate\Auth\Access\HandlesAuthorization;


class UserPolicy extends BasePolicy
{
    use HandlesAuthorization,HasAdmin;

    /**
     * @return string
     */
    protected function model()
    {
        return 'user';
    }
}
