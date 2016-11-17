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
    public function find($id, $columns = ['*']);
}
