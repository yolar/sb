<?php

declare(strict_types=1);

namespace App\Tests\Command;

use App\Command\BurnFuelCommand;
use App\Command\CheckFuelCommand;
use App\Command\MacroCommand;
use App\Command\MoveCommand;
use PHPUnit\Framework\TestCase;

/**
 * @covers \App\Command\MacroCommand
 */
class MacroCommandTest extends TestCase
{
    public function testExecute(): void
    {
        $commands = [
            $this->createMock(CheckFuelCommand::class),
            $this->createMock(MoveCommand::class),
            $this->createMock(BurnFuelCommand::class),
        ];

        foreach ($commands as $command) {
            $command->expects($this->once())->method('execute');
        }

        $macroCommand = new MacroCommand($commands);

        $macroCommand->execute();
    }
}
