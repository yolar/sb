<?php

declare(strict_types=1);

namespace App\Command;

class FirstRetryCommand implements CommandInterface
{
    public function __construct(
        private CommandInterface $command,
    ) {
    }

    public function execute(): void
    {
        $this->command->execute();
    }
}
