<?php

declare(strict_types=1);

namespace App\Tests;

use App\BurnFuelCommand;
use App\CheckFuelCommand;
use App\MacroCommand;
use App\MoveCommand;
use PHPUnit\Framework\TestCase;

/**
 * @covers \App\MacroCommand
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
