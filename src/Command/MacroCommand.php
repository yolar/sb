<?php

declare(strict_types=1);

namespace App\Command;

class MacroCommand implements CommandInterface
{
    /**
     * @param CommandInterface[] $commands
     */
    public function __construct(
        private array $commands
    ) {
    }

    public function execute(): void
    {
        foreach ($this->commands as $command) {
            $command->execute();
        }
    }
}
