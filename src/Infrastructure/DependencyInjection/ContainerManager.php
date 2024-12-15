<?php

declare(strict_types=1);

namespace Yeremi\Ingresso\Infrastructure\DependencyInjection;

use DI\ContainerBuilder;
use Psr\Container\ContainerInterface;

/**
 * @see ContainerManagerTest
 */
class ContainerManager
{
    private static ?ContainerInterface $container = null;

    private static ?ContainerBuilder $containerBuilder = null;

    private static string $environment = 'production';

    public static function setBuilder(ContainerBuilder $containerBuilder): void
    {
        self::$containerBuilder = $containerBuilder;
    }

    public static function setEnvironment(string $environment): void
    {
        self::$environment = $environment;
    }

    public static function getInstance(): ContainerInterface
    {
        $configFile = dirname(__FILE__, 2) . '/Config/config.php';

        if (!self::$container instanceof ContainerInterface) {
            $builder = self::$containerBuilder ?? new ContainerBuilder();
            $builder->useAutowiring(true);
            $builder->addDefinitions($configFile);

            $container = $builder->build();
            self::$container = $container;
        }

        return self::$container;
    }
}
