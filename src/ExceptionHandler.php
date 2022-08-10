<?php

namespace App;

use App\Command\CommandInterface;
use App\Command\FirstRetryCommand;
use App\Command\LogCommand;
use App\Command\SecondRetryCommand;
use Ds\Queue;

class ExceptionHandler
{
    /**
     * @var string[]
     */
    private array $strategies = [
        FirstRetryCommand::class => 'onFirstRetry',
        SecondRetryCommand::class => 'onSecondRetry',
    ];

    public function __construct(
        private Queue $queue,
    ) {
    }

    public function handle(CommandInterface $command, \Throwable $throwable): void
    {
        $handler = $this->strategies[$command::class] ?? 'onException';

        $this->$handler($command, $throwable);
    }

    private function onException(CommandInterface $command, \Throwable $_throwable): void
    {
        $this->queue->push(new FirstRetryCommand($command));
    }

    private function onFirstRetry(CommandInterface $command, \Throwable $_throwable): void
    {
        $this->queue->push(new SecondRetryCommand($command));
    }

    private function onSecondRetry(CommandInterface $_command, \Throwable $throwable): void
    {
        $this->queue->push(new LogCommand($throwable->getMessage()));
    }
}
