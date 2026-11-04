<?php

declare(strict_types=1);

namespace Yeremi\Ingresso\Tests\Unit\Infrastructure\Integration\Repository;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Yeremi\Ingresso\Domain\Entity\SettingsEntity;
use Yeremi\Ingresso\Infrastructure\API\DataHandlerInterface;
use Yeremi\Ingresso\Infrastructure\Integration\Repository\AbstractRepository;
use Yeremi\Ingresso\Presentation\Admin\SettingsManagerInterface;
use Yeremi\RouteMapper\Registry\RouteRegistry;
use Yeremi\RouteMapper\Resolver\RouteResolver;
use Yeremi\SchemaMapper\Normalizer\ApiSchemaNormalizer;

/**
 * Builds repositories with the real route registry/resolver, a fake data handler
 * that records the requested endpoint, and a mocked schema normalizer.
 */
abstract class RepositoryTestCase extends TestCase
{
    protected const CITY_ID = '1';
    protected const THEATER_ID = '42';
    protected const PARTNERSHIP = 'my-partner';

    /** @var list<string> */
    protected array $requestedEndpoints = [];

    protected ApiSchemaNormalizer&MockObject $normalizer;

    protected function setUp(): void
    {
        parent::setUp();
        $this->requestedEndpoints = [];
        $this->normalizer = $this->createMock(ApiSchemaNormalizer::class);
    }

    /**
     * @template T of AbstractRepository
     *
     * @param class-string<T> $repositoryClass
     * @param array $response What the data handler returns for any endpoint.
     *
     * @return T
     */
    protected function createRepository(string $repositoryClass, array $response): AbstractRepository
    {
        $dataHandler = new class ($response, $this->requestedEndpoints) implements DataHandlerInterface {
            /**
             * @param list<string> $endpoints
             */
            public function __construct(
                private readonly array $response,
                private array &$endpoints
            ) {
            }

            public function request(string $endpoint): array
            {
                $this->endpoints[] = $endpoint;
                return $this->response;
            }
        };

        $settingsManager = $this->createMock(SettingsManagerInterface::class);
        $settingsManager->method('getAll')->willReturn(
            SettingsEntity::loadFromOptions([
                'cityId' => self::CITY_ID,
                'theaterId' => self::THEATER_ID,
                'partnership' => self::PARTNERSHIP,
            ])
        );

        return new $repositoryClass(
            $this->normalizer,
            $dataHandler,
            $settingsManager,
            new RouteRegistry(),
            new RouteResolver()
        );
    }

    protected function assertRequestedEndpoint(string $expected): void
    {
        $this->assertSame([$expected], $this->requestedEndpoints);
    }
}
