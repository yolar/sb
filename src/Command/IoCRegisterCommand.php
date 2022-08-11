<?php

declare(strict_types=1);

namespace App\Command;

use App\IoC;

class IoCRegisterCommand implements CommandInterface
{
    public function __construct(
        private string $name,
        private \Closure $closure,
    ) {
    }

    public function execute(): void
    {
        IoC::$scope->registry[$this->name] = $this->closure;
    }
}
