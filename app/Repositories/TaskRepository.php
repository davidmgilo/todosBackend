<?php

namespace App\Respositories;

use App\Respositories\Contracts\Repository;
use App\Task;

class TaskRepository implements Repository
{

    public function find($id, $columns = array('*'))
    {
        return Task::findOrFail($id);
    }
}