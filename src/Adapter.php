<?php

declare(strict_types=1);

namespace App;

use Nette\PhpGenerator\ClassType;

class Adapter
{
    /**
     * @param class-string $interface
     */
    public function __construct(
        private string  $interface,
        private UObject $UObject,
    ) {
    }

    public function __invoke(): object
    {
        $reflection = new \ReflectionClass($this->interface);

        $interfaceName = $reflection->getShortName();
        /** @var class-string $className */
        $className = \sprintf('%sAdapter', str_replace('Interface', '', $interfaceName));

        $class = new ClassType($className);
        $class->addImplement($this->interface);
        $class->addMethod('__construct')
            ->addPromotedParameter('UObject')
            ->setType(UObject::class)
            ->setPrivate();

        foreach ($reflection->getMethods() as $reflectionMethod) {
            $classMethod = $class->addMethod($reflectionMethod->getName());
            $classMethod->setReturnType($reflectionMethod->getReturnType()?->getName());

            $isMethodGetter = str_starts_with($reflectionMethod->getName(), 'get');
            $classMethodParameters = [];

            foreach ($reflectionMethod->getParameters() as $reflectionMethodParameter) {
                $classMethod->addParameter($reflectionMethodParameter->getName())
                    ->setType($reflectionMethodParameter->getType()?->getName());

                if (!$isMethodGetter) {
                    $classMethodParameters[] = '$' . $reflectionMethodParameter->getName();
                }
            }

            $isMethodGetter = str_starts_with($reflectionMethod->getName(), 'get');

            $classMethod->setBody(
                sprintf(
                    '%sApp\IoC::resolve(\'%s:%s\', $this->UObject%s);',
                    $isMethodGetter ? 'return ' : '',
                    $interfaceName,
                    $reflectionMethod->getName(),
                    $isMethodGetter ? '' : ', ' . implode(', ', $classMethodParameters),
                )
            );
        }

        eval($class);

        return new $className($this->UObject);
    }
}
