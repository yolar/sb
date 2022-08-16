<?php

declare(strict_types=1);

namespace App\Tests;

use App\Command\MoveCommand;
use App\Command\RotateCommand;
use App\Exception\IoCException;
use App\IoC;
use PHPUnit\Framework\TestCase;

/**
 * @covers \App\IoC
 */
class IoCTest extends TestCase
{
    public function testResolver(): void
    {
        /** @psalm-suppress MixedMethodCall */
        (IoC::resolve(
            'IoC.Register',
            'MoveStraight',
            fn () => $this->createMock(MoveCommand::class),
        ))->execute();

        $this->assertEquals(IoC::resolve('MoveStraight'), $this->createMock(MoveCommand::class));
    }

    public function testScopes(): void
    {
        /** @psalm-suppress MixedMethodCall */
        (IoC::resolve('Scope.Create', 'Alpha'))->execute();
        /** @psalm-suppress MixedMethodCall */
        (IoC::resolve('Scope.Set', 'Alpha'))->execute();

        /** @psalm-suppress MixedMethodCall */
        (IoC::resolve(
            'IoC.Register',
            'FastRotate',
            fn () => $this->createMock(RotateCommand::class),
        ))->execute();

        $this->assertEquals(IoC::resolve('FastRotate'), $this->createMock(RotateCommand::class));

        /** @psalm-suppress MixedMethodCall */
        (IoC::resolve('Scope.Create', 'Bravo'))->execute();
        /** @psalm-suppress MixedMethodCall */
        (IoC::resolve('Scope.Set', 'Bravo'))->execute();

        $this->expectException(IoCException::class);

        IoC::resolve('FastRotate');
    }
}
