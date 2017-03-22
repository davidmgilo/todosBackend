<?php

namespace Davidmgilo\TodosBackend\Transformers;

use Davidmgilo\TodosBackend\Exceptions\IncorrectModelException;

/**
 * Class UserTransformer.
 */
class UserTransformer extends Transformer
{
    /**
     * @param $resource
     *
     * @throws IncorrectModelException
     *
     * @return array
     */
    public function transform($resource)
    {
        if (!$resource instanceof \Davidmgilo\TodosBackend\User) {
            throw new IncorrectModelException();
        }

        return [
            'name'  => $resource['name'],
            'email' => $resource['email'],
//            'api_token' => $resource['api_token'],

        ];
    }
}
