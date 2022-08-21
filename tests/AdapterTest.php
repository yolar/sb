<?php

declare(strict_types=1);

namespace App\Tests;

use App\Adapter;
use App\IoC;
use App\MovableInterface;
use App\RotableInterface;
use App\UObject;
use App\Vector;
use PHPUnit\Framework\TestCase;

/**
 * @covers \App\Adapter
 */
class AdapterTest extends TestCase
{
    public function testGenerateClass(): void
    {
        (IoC::resolve(
            'IoC.Register',
            'Adapter',
            fn (string $interfaceName): object => (new Adapter($interfaceName, new UObject()))()
        ))->execute();

        (IoC::resolve(
            'IoC.Register',
            'MovableInterface:setPosition',
            fn (UObject $UObject, Vector $position) => $UObject->position = $position
        ))->execute();

        (IoC::resolve(
            'IoC.Register',
            'MovableInterface:getPosition',
            fn (UObject $UObject): Vector => $UObject->position
        ))->execute();

        /** @var MovableInterface $movableAdapter */
        $movableAdapter = IoC::resolve('Adapter', MovableInterface::class);
        $position = new Vector(20, -10);
        $movableAdapter->setPosition($position);

        $this->assertInstanceOf(MovableInterface::class, $movableAdapter);
        $this->assertEquals($position, $movableAdapter->getPosition());
    }
}
