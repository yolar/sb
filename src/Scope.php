<?php

declare(strict_types=1);

namespace App;

class Scope
{
    /**
     * @param array<string, \Closure> $registry
     */
    public function __construct(
        public array $registry = [],
    ) {
    }
}
