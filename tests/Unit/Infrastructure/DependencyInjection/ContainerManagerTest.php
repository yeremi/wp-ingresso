<?php

declare(strict_types=1);

namespace Yeremi\Ingresso\Tests\Unit\Infrastructure\DependencyInjection;

use ReflectionClass;
use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerInterface;
use Yeremi\Ingresso\Infrastructure\DependencyInjection\ContainerManager;

/**
 * Unit tests for the ContainerManager class.
 *
 * @covers ContainerManager
 */
class ContainerManagerTest extends TestCase
{
    /**
     * Set up the test environment by resetting the environment to "development".
     */
    protected function setUp(): void
    {
        parent::setUp();
        ContainerManager::setEnvironment('development');
    }

    /**
     * Test that getInstance returns an instance implementing ContainerInterface.
     * Ensures that the dependency injection container complies with PSR-11.
     */
    public function testGetInstanceReturnsContainerInterface(): void
    {
        $container = ContainerManager::getInstance();

        $this->assertInstanceOf(
            ContainerInterface::class,
            $container,
            'Expected instance of ContainerInterface.'
        );
    }

    /**
     * Test that getInstance always returns the same instance (singleton pattern).
     * Ensures that multiple calls to getInstance do not create new instances.
     */
    public function testGetInstanceIsSingleton(): void
    {
        $container = ContainerManager::getInstance();
        $secondInstance = ContainerManager::getInstance();

        $this->assertSame(
            $container,
            $secondInstance,
            'Expected getInstance to return the same instance.'
        );
    }

    /**
     * Test that the configuration file exists.
     * Ensures that the DI container has a valid configuration file to load definitions from.
     */
    public function testConfigFileExists(): void
    {
        $configFile = dirname(__FILE__, 5) . '/src/Infrastructure/Config/config.php';

        $this->assertFileExists(
            $configFile,
            'The configuration file is missing.'
        );
    }

    /**
     * Test that the environment setting is respected.
     * Ensures that the environment can be changed and is correctly stored.
     */
    public function testEnvironmentIsRespected(): void
    {
        ContainerManager::setEnvironment('production');

        $this->assertEquals(
            'production',
            $this->getPrivateProperty(ContainerManager::class, 'environment'),
            'The environment property was not correctly set to production.'
        );
    }

    /**
     * Helper method to access private properties for testing purposes.
     *
     * @param string $class The class name containing the private property.
     * @param string $property The name of the private property.
     *
     * @return mixed The value of the private property.
     */
    private function getPrivateProperty(string $class, string $property): mixed
    {
        $reflectionClass = new ReflectionClass($class);
        $reflectionProperty = $reflectionClass->getProperty($property);
        $reflectionProperty->setAccessible(true);

        return $reflectionProperty->getValue();
    }
}
