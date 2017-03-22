<?php

namespace Davidmgilo\TodosBackend\Repositories\Contracts;

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

    public function paginate($perPage = 15, $columns = array('*'));

    public function create(array $data);

    public function update(array $data, $id);

    public function delete($id);
    //https://bosnadev.com/2015/03/07/using-repository-pattern-in-laravel-5/
}
