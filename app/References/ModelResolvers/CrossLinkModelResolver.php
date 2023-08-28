<?php

namespace App\References\ModelResolvers;

use App\Model;

interface CrossLinkModelResolver
{
    /**
     * Resolve the given href link value to a model.
     */
    public function resolve(string $link): ?Model;
}
