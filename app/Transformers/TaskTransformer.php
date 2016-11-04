<?php
use App\Exceptions\IncorrectModelException;


class TaskTransformer
{
    protected function transform($resource)
    {
        if(! $resource instanceof \App\Task){
            throw new IncorrectModelException();
        }
        return [
            'name' => $resource['name'],
            'done' => (boolean)$resource['done'],
            'priority' => (integer)$resource['priority'],

        ];
    }
}