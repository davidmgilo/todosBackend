<?php

namespace App\Transformers\Contracts;

/**
 * Interface Transformer
 * @package App\Transformers\Contracts
 */
interface Transformer
{
    /**
     * @param $resource
     * @return mixed
     */
    public function transform($resource);

    /**
     * @param $resources
     * @return mixed
     */
    public function transformCollections($resources);
}
