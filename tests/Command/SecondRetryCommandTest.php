<?php

declare(strict_types=1);

namespace App\Tests\Command;

use App\Command\CommandInterface;
use App\Command\SecondRetryCommand;
use PHPUnit\Framework\TestCase;

/**
 * @covers \App\Command\SecondRetryCommand
 */
class SecondRetryCommandTest extends TestCase
{
    public function testExecute(): void
    {
        $command = $this->createMock(CommandInterface::class);
        $command->expects($this->once())
            ->method('execute');

        (new SecondRetryCommand($command))->execute();
    }
}
