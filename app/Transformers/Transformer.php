<?php
/**
 * Created by PhpStorm.
 * User: alumne
 * Date: 11/11/16
 * Time: 15:48.
 */
namespace App\Transformers;

use App\Transformers\Contracts\Transformer as TransformerContract;

abstract class Transformer implements TransformerContract
{
    public function transformCollections($resources)
    {
        //Collections : Laravel collections

        return array_map(function ($resource) {
            return $this->transform($resource);
        }, $resources);
    }
}
