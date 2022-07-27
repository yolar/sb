<?php

declare(strict_types=1);

namespace App;

interface FuelInterface
{
    public function getAmount(): int;

    public function setAmount(int $amount): void;

    public function getConsumption(): int;
}
