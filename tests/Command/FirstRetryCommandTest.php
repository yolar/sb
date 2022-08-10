<?php

declare(strict_types=1);

namespace App\Tests\Command;

use App\Command\CommandInterface;
use App\Command\FirstRetryCommand;
use PHPUnit\Framework\TestCase;

/**
 * @covers \App\Command\FirstRetryCommand
 */
class FirstRetryCommandTest extends TestCase
{
    public function testExecute(): void
    {
        $command = $this->createMock(CommandInterface::class);
        $command->expects($this->once())
            ->method('execute');

        (new FirstRetryCommand($command))->execute();
    }
}
