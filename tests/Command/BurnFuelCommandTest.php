<?php

declare(strict_types=1);

namespace App\Tests\Command;

use App\Command\BurnFuelCommand;
use App\FuelInterface;
use PHPUnit\Framework\TestCase;

/**
 * @covers \App\Command\BurnFuelCommand
 */
class BurnFuelCommandTest extends TestCase
{
    public function testReducesTheAmountOfFuel(): void
    {
        $fuel = $this->createMock(FuelInterface::class);
        $fuel->expects($this->once())
            ->method('getAmount')
            ->willReturn(100);
        $fuel->expects($this->once())
            ->method('getConsumption')
            ->willReturn(10);
        $fuel->expects($this->once())
            ->method('setAmount')
            ->with(90);

        $command = new BurnFuelCommand($fuel);
        $command->execute();
    }
}
