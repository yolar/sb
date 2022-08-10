<?php

declare(strict_types=1);

namespace App\Tests\Command;

use App\Command\LogCommand;
use PHPUnit\Framework\TestCase;

/**
 * @covers \App\Command\LogCommand
 */
class LogCommandTest extends TestCase
{
    public function testMessageIsLogged(): void
    {
        $message = 'Lorem ipsum dolor sit amet';

        (new LogCommand($message, 'php://output'))->execute();

        $this->expectOutputRegex("/$message/");
    }
}
