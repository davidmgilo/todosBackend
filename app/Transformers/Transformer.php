<?php
/**
 * Created by PhpStorm.
 * User: alumne
 * Date: 11/11/16
 * Time: 15:48.
 */

namespace Davidmgilo\TodosBackend\Transformers;

use Davidmgilo\TodosBackend\Transformers\Contracts\Transformer as TransformerContract;

/**
 * Class Transformer.
 */
abstract class Transformer implements TransformerContract
{
    /**
     * @param $resources
     *
     * @return array
     */
    public function transformCollections($resources)
    {
        //Collections : Laravel collections

        return array_map(function ($resource) {
            return $this->transform($resource);
        }, $resources);
    }
}
