<?php

declare(strict_types=1);

namespace App;

class Vector
{
    public function __construct(
        private int $x = 0,
        private int $y = 0,
    ) {
    }

    public function plus(Vector $v1, Vector $v2): self
    {
        return new self($v1->x + $v2->x, $v1->y + $v2->y);
    }
}
