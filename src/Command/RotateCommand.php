<?php

declare(strict_types=1);

namespace App\Command;

use App\RotableInterface;

class RotateCommand implements CommandInterface
{
    public function __construct(
        private RotableInterface $rotable
    ) {
    }

    public function execute(): void
    {
        $this->rotable->setDirection(
            ($this->rotable->getDirection() + $this->rotable->getAngularVelocity()) % $this->rotable->getDirectionsNumber()
        );
    }
}
