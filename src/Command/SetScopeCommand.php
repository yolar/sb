<?php

declare(strict_types=1);

namespace App\Command;

use App\IoC;

class SetScopeCommand implements CommandInterface
{
    public function __construct(
        private string $name,
    ) {
    }

    public function execute(): void
    {
        IoC::$scope = IoC::$scopes[$this->name];
    }
}
