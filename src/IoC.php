<?php

declare(strict_types=1);

namespace App;

use App\Command\CreateScopeCommand;
use App\Command\IoCRegisterCommand;
use App\Command\SetScopeCommand;
use App\Exception\IoCException;

class IoC
{
    /**
     * @var array<string, Scope>
     */
    public static array $scopes = [];
    public static Scope $scope;

    public static function resolve(string $name, mixed ...$arguments): mixed
    {
        /** @psalm-suppress RedundantPropertyInitializationCheck */
        if (!isset(self::$scope)) {
            self::$scope = new Scope([
                'IoC.Register' => fn (string $name, \Closure $callback): IoCRegisterCommand => new IoCRegisterCommand($name, $callback),
                'Scope.Create' => fn (string $name): CreateScopeCommand => new CreateScopeCommand($name),
                'Scope.Set' => fn (string $name): SetScopeCommand => new SetScopeCommand($name)
            ]);
            self::$scopes['root'] = self::$scope;
        }

        if (isset(self::$scope->registry[$name])) {
            return self::$scope->registry[$name](...$arguments);
        }

        if (isset(self::$scopes['root']->registry[$name])) {
            return self::$scopes['root']->registry[$name](...$arguments);
        }

        throw new IoCException(\sprintf('Unable to resolve %s', $name));
    }
}
