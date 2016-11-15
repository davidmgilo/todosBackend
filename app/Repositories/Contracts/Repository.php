<?php

namespace App\Repositories\Contracts;

/**
 * Interface Repository
 * @package App\Repositories\Contracts
 */
interface Repository
{
    /**
     * @param $id
     * @param array $columns
     * @return mixed
     */
    public function find($id, $columns = array('*'));
}