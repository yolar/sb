<?php

declare(strict_types=1);

namespace App\Tests;

use App\CommandInterface;
use App\ExceptionHandler;
use App\FirstRetryCommand;
use App\LogCommand;
use App\SecondRetryCommand;
use Ds\Queue;
use PHPUnit\Framework\TestCase;

/**
 * @covers \App\ExceptionHandler
 */
class ExceptionHandlerTest extends TestCase
{
    public function testHandle(): void
    {
        $command = $this->createMock(CommandInterface::class);
        $exception = new \InvalidArgumentException('Invalid argument');
        $queue = new Queue([$command]);
        $exceptionHandler = new ExceptionHandler($queue);

        $exceptionHandler->handle($queue->pop(), $exception);
        $this->assertInstanceOf(FirstRetryCommand::class, $queue->copy()->pop());

        $exceptionHandler->handle($queue->pop(), $exception);
        $this->assertInstanceOf(SecondRetryCommand::class, $queue->copy()->pop());

        $exceptionHandler->handle($queue->pop(), $exception);
        $this->assertInstanceOf(LogCommand::class, $queue->copy()->pop());
    }
}
