<?php

declare(strict_types=1);

namespace App\Tests;

use App\CommandInterface;
use App\SecondRetryCommand;
use PHPUnit\Framework\TestCase;

/**
 * @covers \App\SecondRetryCommand
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
