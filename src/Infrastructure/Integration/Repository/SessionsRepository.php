<?php

declare(strict_types=1);

namespace Yeremi\Ingresso\Infrastructure\Integration\Repository;

use Yeremi\Ingresso\Domain\Repositories\SessionsRepositoryInterface;
use Yeremi\Ingresso\Domain\ValueObject\Exists;
use Yeremi\Ingresso\Domain\ValueObject\GenericSession;
use Yeremi\Ingresso\Domain\ValueObject\ShowTimeByMovie;
use Yeremi\Ingresso\Domain\ValueObject\ShowtimeByTheater;
use Yeremi\Ingresso\Domain\ValueObject\ShowtimeDates;
use Yeremi\RouteMapper\Attribute\ApiRoute;

class SessionsRepository extends AbstractRepository implements SessionsRepositoryInterface
{
    #[ApiRoute('/sessions/{id}/partnership/{partnership}')]
    public function fetchOne(string $id): ?GenericSession
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

        /** @var GenericSession $result */
        $result = $this->apiSchemaNormalizer->normalize($response, GenericSession::class);
        return $result;
    }

    #[ApiRoute('/sessions/city/{cityId}/theater/{theaterId}/partnership/{partnership}')]
    public function fetchByCityAndTheater(): ?ShowtimeByTheater
    {
        $parameters = [
            'cityId' => $this->settingsEntity->getCityId(),
            'theaterId' => $this->settingsEntity->getTheaterId(),
            'partnership' => $this->settingsEntity->getPartnership(),
        ];

        $route = $this->resolveRoute(__FUNCTION__, $parameters);
        $response = $this->dataHandler->request($route);
        if (!$response) {
            return null;
        }

        /** @var ShowtimeByTheater $return */
        $return = $this->apiSchemaNormalizer->normalize($response, ShowtimeByTheater::class);
        return $return;
    }

    #[ApiRoute('/sessions/city/{cityId}/event/{eventId}/partnership/{partnership}')]
    public function fetchByCityAndEvent(string $eventId): array
    {
        $parameters = [
            'cityId' => $this->settingsEntity->getCityId(),
            'eventId' => $eventId,
            'partnership' => $this->settingsEntity->getPartnership(),
        ];

        $route = $this->resolveRoute(__FUNCTION__, $parameters);
        $response = $this->dataHandler->request($route);
        if (!$response) {
            return [];
        }

        /** @var ShowTimeByMovie[] $return */
        $return = $this->apiSchemaNormalizer->normalize($response, ShowTimeByMovie::class);
        return $return;
    }

    #[ApiRoute('/sessions/event/{eventId}/partnership/{partnership}')]
    public function fetchByEventAndPartnership(string $eventId): array
    {
        $parameters = [
            'eventId' => $eventId,
            'partnership' => $this->settingsEntity->getPartnership(),
        ];

        $route = $this->resolveRoute(__FUNCTION__, $parameters);
        $response = $this->dataHandler->request($route);
        if (!$response) {
            return [];
        }

        /** @var ShowTimeByMovie[] $return */
        $return = $this->handleRequest($response, ShowTimeByMovie::class);
        return $return;
    }

    #[ApiRoute('/sessions/city/{cityId}/event/{eventId}/dates/partnership/{partnership}')]
    public function fetchDatedByEvent(string $eventId): ?ShowtimeDates
    {
        $parameters = [
            'eventId' => $eventId,
            'partnership' => $this->settingsEntity->getPartnership(),
        ];

        $route = $this->resolveRoute(__FUNCTION__, $parameters);
        $response = $this->dataHandler->request($route);
        if (!$response) {
            return null;
        }

        /** @var ShowtimeDates $return */
        $return = $this->apiSchemaNormalizer->normalize($response, ShowtimeDates::class);
        return $return;
    }

    #[ApiRoute('/sessions/url-key/{urlKey}/exists')]
    public function fetchSessionExists(string $urlKey): ?Exists
    {
        $parameters = [
            'urlKey' => $urlKey,
        ];

        $route = $this->resolveRoute(__FUNCTION__, $parameters);
        $response = $this->dataHandler->request($route);
        if (!$response) {
            return null;
        }

        /** @var Exists $return */
        $return = $this->apiSchemaNormalizer->normalize($response, Exists::class);
        return $return;
    }
}
