<?php

namespace App\Transformers;

use App\Exceptions\IncorrectModelException;

/**
 * Class UserTransformer
 * @package App\Transformers
 */
class UserTransformer extends Transformer
{
    /**
     * @param $resource
     * @return array
     * @throws IncorrectModelException
     */
    public function transform($resource)
    {
        if (!$resource instanceof \App\User) {
            throw new IncorrectModelException();
        }

        return [
            'name'  => $resource['name'],
            'email' => $resource['email'],

        ];
    }
}
