<?php

declare(strict_types=1);

namespace App\Command;

use App\FuelInterface;

class BurnFuelCommand implements CommandInterface
{
    public function __construct(
        private FuelInterface $fuel,
    ) {
    }

    public function execute(): void
    {
        $this->fuel->setAmount($this->fuel->getAmount() - $this->fuel->getConsumption());
    }
}
