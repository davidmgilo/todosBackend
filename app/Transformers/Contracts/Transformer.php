<?php

namespace App\Transformers\Contracts;

interface Transformer
{
    public function transform($resource);

    public function transformCollections($resources);
}
