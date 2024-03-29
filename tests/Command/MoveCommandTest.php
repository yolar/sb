<?php

declare(strict_types=1);

namespace App\Tests\Command;

use App\Command\MoveCommand;
use App\MovableInterface;
use App\Vector;
use PHPUnit\Framework\TestCase;

/**
 * @covers \App\Command\MoveCommand
 */
class MoveCommandTest extends TestCase
{
    public function testObjectCanBeMoved(): void
    {
        $movable = $this->createMock(MovableInterface::class);
        $movable->expects($this->once())
            ->method('getPosition')
            ->willReturn(new Vector(12, 5));
        $movable->expects($this->once())
            ->method('getVelocity')
            ->willReturn(new Vector(-7, 3));
        $movable->expects($this->once())
            ->method('setPosition')
            ->with(new Vector(5, 8));

        $move = new MoveCommand($movable);
        $move->execute();
    }

    public function testUnableToGetPosition(): void
    {
        $movable = $this->createMock(MovableInterface::class);
        $movable->method('getPosition')
            ->willThrowException(new \Exception());

        $this->expectException(\Exception::class);

        $move = new MoveCommand($movable);
        $move->execute();
    }

    public function testUnableToSetPosition(): void
    {
        $movable = $this->createMock(MovableInterface::class);
        $movable->expects($this->once())
            ->method('getPosition')
            ->willReturn(new Vector());
        $movable->expects($this->once())
            ->method('getVelocity')
            ->willReturn(new Vector());
        $movable->method('setPosition')
            ->willThrowException(new \Exception());

        $this->expectException(\Exception::class);

        $move = new MoveCommand($movable);
        $move->execute();
    }

    public function testUnableToGetVelocity(): void
    {
        $movable = $this->createMock(MovableInterface::class);
        $movable->expects($this->once())
            ->method('getPosition')
            ->willReturn(new Vector());
        $movable->method('getVelocity')
            ->willThrowException(new \Exception());

        $this->expectException(\Exception::class);

        $move = new MoveCommand($movable);
        $move->execute();
    }
}
