<?php

declare(strict_types=1);

namespace App\Command;

use App\IoC;
use App\Scope;

class CreateScopeCommand implements CommandInterface
{
    public function __construct(
        private string $name,
    ) {
    }

    public function execute(): void
    {
        IoC::$scopes[$this->name] = new Scope();
    }
}
