<?php

declare(strict_types=1);

namespace Yeremi\Ingresso\Infrastructure\Integration\Repository;

use Yeremi\Ingresso\Domain\Repositories\TemplatesRepositoryInterface;
use Yeremi\Ingresso\Domain\ValueObject\EventList;
use Yeremi\Ingresso\Domain\ValueObject\Highlight;
use Yeremi\RouteMapper\Attribute\ApiRoute;

class TemplatesRepository extends AbstractRepository implements TemplatesRepositoryInterface
{
    #[ApiRoute('/templates/soon/{cityId}/partnership/{partnership}')]
    public function getSoon(): ?EventList
    {
        $parameters = [
            'cityId' => $this->settingsEntity->getCityId(),
            'partnership' => $this->settingsEntity->getPartnership(),
        ];

        $route = $this->resolveRoute(__FUNCTION__, $parameters);
        $response = $this->dataHandler->request($route);
        if (!$response) {
            return null;
        }

        /** @var EventList $result */
        $result = $this->apiSchemaNormalizer->normalize($response, EventList::class);
        return $result;
    }

    #[ApiRoute('/templates/nowplaying/{cityId}/partnership/{partnership}')]
    public function getNowPlayingByCityAndPartnership(): ?EventList
    {

        $parameters = [
            'cityId' => $this->settingsEntity->getCityId(),
            'partnership' => $this->settingsEntity->getPartnership(),
        ];

        $route = $this->resolveRoute(__FUNCTION__, $parameters);
        $response = $this->dataHandler->request($route);
        if (!$response) {
            return null;
        }

        /** @var EventList $result */
        $result = $this->apiSchemaNormalizer->normalize($response, EventList::class);
        return $result;
    }

    #[ApiRoute('/templates/highlights/{cityId}/partnership/{partnership}?theatersIds={theatersIds}')]
    public function getHighlightsByCityAndPartnership(): array
    {

        $parameters = [
            'cityId' => $this->settingsEntity->getCityId(),
            'partnership' => $this->settingsEntity->getPartnership(),
            'theatersIds' => $this->settingsEntity->getTheaterId(),
        ];

        $route = $this->resolveRoute(__FUNCTION__, $parameters);
        $response = $this->dataHandler->request($route);
        if (!$response) {
            return [];
        }

        return (array) $this->handleRequest($response, Highlight::class);
    }
}
