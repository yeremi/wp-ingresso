<?php

declare(strict_types=1);

namespace Yeremi\Ingresso\Application\UseCases;

use Yeremi\Ingresso\Domain\Repositories\SessionsRepositoryInterface;
use Yeremi\Ingresso\Domain\ValueObject\GenericSession;
use Yeremi\Ingresso\Domain\ValueObject\ShowTimeByMovie;
use Yeremi\Ingresso\Domain\ValueObject\ShowtimeByTheater;
use Yeremi\Ingresso\Domain\ValueObject\ShowtimeDates;

class FetchSessionsUseCase
{
    use UseCaseTrait;

    public function __construct(
        private SessionsRepositoryInterface $sessionsRepository
    ) {
    }

    public function getOne(string $id): GenericSession
    {
        $result = $this->sessionsRepository->fetchOne($id);
        if (is_null($result)) {
            return new GenericSession();
        }

        return $result;
    }

    public function getByCityAndTheater(): ShowtimeByTheater
    {
        $result = $this->sessionsRepository->fetchByCityAndTheater();
        if (is_null($result)) {
            return new ShowtimeByTheater();
        }

        return $result;
    }

    public function getByCityAndEvent(string $eventId): array
    {
        $result = $this->sessionsRepository->fetchByCityAndEvent($eventId);
        if (is_null($result)) {
            return [];
        }

        return $result;
    }

    public function getByEventAndPartnership(string $eventId): array
    {
        $result = $this->sessionsRepository->fetchByEventAndPartnership($eventId);
        if (is_null($result)) {
            return [];
        }

        foreach ($result as $item) {
            if (!$item instanceof ShowTimeByMovie) {
                return [];
            }
        }

        return $result;
    }

    public function getDatedByEvent(string $eventId): ShowtimeDates
    {
        $result = $this->sessionsRepository->fetchDatedByEvent($eventId);
        if (is_null($result)) {
            return new ShowtimeDates();
        }

        return $result;
    }

    public function getSessionExists(string $urlKey): bool
    {
        $result = $this->sessionsRepository->fetchSessionExists($urlKey);
        if (is_null($result)) {
            return false;
        }

        return ($result->getStatus() === 404) ? false : true;
    }
}
