<?php

declare(strict_types=1);

namespace App\Tests;

use App\CommandInterface;
use App\FirstRetryCommand;
use PHPUnit\Framework\TestCase;

/**
 * @covers \App\FirstRetryCommand
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
