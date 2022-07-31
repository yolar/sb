<?php

declare(strict_types=1);

namespace App;

class SecondRetryCommand implements CommandInterface
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
