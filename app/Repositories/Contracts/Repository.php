<?php

namespace App\Respositories\Contracts;

interface Repository
{
    public function find($id, $columns = array('*'));
}