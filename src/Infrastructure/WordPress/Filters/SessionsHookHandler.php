<?php

declare(strict_types=1);

namespace Yeremi\Ingresso\Infrastructure\WordPress\Filters;

use Yeremi\Ingresso\Application\UseCases\FetchSessionsUseCase;
use Yeremi\Ingresso\Domain\ValueObject\GenericSession;
use Yeremi\Ingresso\Domain\ValueObject\ShowTimeByMovie;
use Yeremi\Ingresso\Infrastructure\WordPress\FilterName;

class SessionsHookHandler
{
    use FilterName;

    public function __construct(
        private readonly FetchSessionsUseCase $fetchSessionsUseCase,
    ) {

        add_filter(self::FILTER_SESSION_ONE, $this->filterOne(...));
        add_filter(self::FILTER_SESSION_BY_CITY_EVENT, $this->filterByCityAndEvent(...));
        add_filter(self::FILTER_SESSION_BY_EVENT_PARTNERSHIP, $this->filterByEventAndPartnership(...));
        add_filter(self::FILTER_SESSION_EXISTS, $this->sessionExists(...));
    }

    public function filterOne(string $id): ?GenericSession
    {
        return $this->fetchSessionsUseCase->getOne($id);
    }

    public function filterByCityAndEvent(string $eventId): array
    {
        /** @var ShowTimeByMovie[] $response */
        $response = $this->fetchSessionsUseCase->getByCityAndEvent($eventId);
        return $response;
    }

    /**
     * @param string $eventId
     *
     * @return array
     */
    public function filterByEventAndPartnership(string $eventId): array
    {
        /** @var ShowTimeByMovie[] $response */
        $response = $this->fetchSessionsUseCase->getByEventAndPartnership($eventId);
        return $response;
    }

    public function sessionExists(string $urlKey): bool
    {
        return $this->fetchSessionsUseCase->getSessionExists($urlKey);
    }
}
