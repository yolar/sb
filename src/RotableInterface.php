<?php

declare(strict_types=1);

namespace App;

interface RotableInterface
{
    public function getDirection(): int;

    public function setDirection(int $direction): void;

    public function getAngularVelocity(): int;

    public function getDirectionsNumber(): int;
}
