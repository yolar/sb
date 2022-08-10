<?php

declare(strict_types=1);

namespace App\Tests\Command;

use App\Command\CheckFuelCommand;
use App\Exception\CommandException;
use App\FuelInterface;
use PHPUnit\Framework\TestCase;

/**
 * @covers \App\Command\CheckFuelCommand
 */
class CheckFuelCommandTest extends TestCase
{
    public function testExceptionThrownIfFuelNotEnough(): void
    {
        $fuel = $this->createMock(FuelInterface::class);
        $fuel->expects($this->once())
            ->method('getAmount')
            ->willReturn(5);
        $fuel->expects($this->once())
            ->method('getConsumption')
            ->willReturn(10);

        $this->expectException(CommandException::class);

        $command = new CheckFuelCommand($fuel);
        $command->execute();
    }
}
