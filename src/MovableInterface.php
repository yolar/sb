<?php

declare(strict_types=1);

namespace App;

interface MovableInterface
{
    public function getPosition(): Vector;

    public function setPosition(Vector $position): void;

    public function getVelocity(): Vector;
}
