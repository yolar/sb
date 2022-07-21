<?php

declare(strict_types=1);

namespace App;

use App\Exception\CommandException;

class CheckFuelCommand implements CommandInterface
{
    public function __construct(
        private FuelInterface $fuel,
    ) {
    }

    public function execute(): void
    {
        if ($this->fuel->getAmount() < $this->fuel->getConsumption()) {
            throw new CommandException('Not enough fuel');
        }
    }
}
