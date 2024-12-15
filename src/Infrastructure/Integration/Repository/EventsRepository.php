<?php

declare(strict_types=1);

namespace Yeremi\Ingresso\Infrastructure\Integration\Repository;

use ReflectionException;
use Yeremi\Ingresso\Domain\Repositories\EventsRepositoryInterface;
use Yeremi\Ingresso\Domain\ValueObject\Event;
use Yeremi\Ingresso\Domain\ValueObject\EventList;
use Yeremi\RouteMapper\Attribute\ApiRoute;

class EventsRepository extends AbstractRepository implements EventsRepositoryInterface
{
    /**
     * @throws ReflectionException
     */
    #[ApiRoute('/events/partnership/{partnership}')]
    public function fetchAllAvailable(): ?EventList
    {
        $parameters = [
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

    /**
     * @throws ReflectionException
     */
    #[ApiRoute('/events/city/{cityId}/partnership/{partnership}')]
    public function fetchAllByCity(): ?EventList
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

    /**
     * @throws ReflectionException
     */
    #[ApiRoute('/events/{id}/partnership/{partnership}')]
    public function fetchOne(string $id): ?Event
    {
        $parameters = [
            'id' => $id,
            'partnership' => $this->settingsEntity->getPartnership(),
        ];

        $route = $this->resolveRoute(__FUNCTION__, $parameters);
        $response = $this->dataHandler->request($route);
        if (!$response) {
            return null;
        }

        /** @var Event $result */
        $result = $this->apiSchemaNormalizer->normalize($response, Event::class);
        return $result;
    }

    /**
     * @throws ReflectionException
     */
    #[ApiRoute('/events/coming-soon/partnership/{partnership}')]
    public function fetchComingSoon(): ?EventList
    {
        $parameters = [
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
}
