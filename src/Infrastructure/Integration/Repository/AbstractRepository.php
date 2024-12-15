<?php

declare(strict_types=1);

namespace Yeremi\Ingresso\Infrastructure\Integration\Repository;

use RuntimeException;
use Exception;
use ReflectionException;
use Yeremi\Ingresso\Domain\Entity\SettingsEntity;
use Yeremi\Ingresso\Infrastructure\API\DataHandlerInterface;
use Yeremi\RouteMapper\Attribute\ApiRoute;
use Yeremi\RouteMapper\Registry\RouteRegistry;
use Yeremi\RouteMapper\Resolver\RouteResolver;
use Yeremi\SchemaMapper\Normalizer\ApiSchemaNormalizer;
use Yeremi\Ingresso\Presentation\Admin\SettingsManagerInterface;

/**
 * https://api-content.ingresso.com/swagger/index.html
 */
abstract class AbstractRepository
{
    protected SettingsEntity $settingsEntity;

    public function __construct(
        protected ApiSchemaNormalizer $apiSchemaNormalizer,
        protected DataHandlerInterface $dataHandler,
        SettingsManagerInterface $settingsManager,
        protected RouteRegistry $routeRegistry,
        protected RouteResolver $routeResolver
    ) {

        $this->settingsEntity = $settingsManager->getAll();
        $this->routeRegistry->registerRoutes($this);
    }

    /**
     * @throws Exception
     */
    protected function resolveRoute(string $methodName, array $parameters): string
    {
        $route = $this->routeRegistry->getRoute(static::class, $methodName);
        if (!$route instanceof ApiRoute) {
            throw new RuntimeException(
                sprintf("Route not found for method: %s", esc_html($methodName))
            );
        }

        return $this->routeResolver->resolve($route, $parameters);
    }

    /**
     * @param array|null $response
     * @param string $targetClass
     *
     * @return mixed
     * @throws ReflectionException
     */
    protected function handleRequest(array|null $response, string $targetClass): mixed
    {
        if (is_null($response)) {
            return [];
        }

        return array_map(
            fn (array $data): object => $this->apiSchemaNormalizer->normalize(
                $data,
                $targetClass
            ),
            $response
        );
    }
}
