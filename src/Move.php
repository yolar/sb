<?php

declare(strict_types=1);

namespace App;

class Move
{
    public function __construct(
        private MovableInterface $movable,
    ) {
    }

    public function execute(): void
    {
        $this->movable->setPosition(
            (new Vector())->plus(
                $this->movable->getPosition(),
                $this->movable->getVelocity()
            )
        );
    }
}
