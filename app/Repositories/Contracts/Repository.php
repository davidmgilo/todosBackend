<?php

namespace App\Repositories\Contracts;

/**
 * Interface Repository.
 */
interface Repository
{
    /**
     * @param $id
     * @param array $columns
     *
     * @return mixed
     */
    public function findOrFail($id, $columns = ['*']);
    //https://bosnadev.com/2015/03/07/using-repository-pattern-in-laravel-5/
}
