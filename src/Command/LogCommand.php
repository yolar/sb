<?php

declare(strict_types=1);

namespace App\Command;

class LogCommand implements CommandInterface
{
    public function __construct(
        private string $message,
        private string $path = 'php://stdout',
    ) {
    }

    public function execute(): void
    {
        $file = new \SplFileObject($this->path, 'a');
        $file->fwrite(\sprintf('[%s] - %s%s', date('d-m-y h:i:s'), $this->message, PHP_EOL));
    }
}
