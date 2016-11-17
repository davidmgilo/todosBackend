<?php

namespace App\Transformers\Contracts;

/**
 * Interface Transformer.
 */
interface Transformer
{
    /**
     * @param $resource
     *
     * @return mixed
     */
    public function transform($resource);

    /**
     * @param $resources
     *
     * @return mixed
     */
    public function transformCollections($resources);
}
