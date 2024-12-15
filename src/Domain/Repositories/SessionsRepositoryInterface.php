<?php

declare(strict_types=1);

namespace Yeremi\Ingresso\Domain\Repositories;

use Yeremi\Ingresso\Domain\ValueObject\Exists;
use Yeremi\Ingresso\Domain\ValueObject\GenericSession;
use Yeremi\Ingresso\Domain\ValueObject\ShowTimeByMovie;
use Yeremi\Ingresso\Domain\ValueObject\ShowtimeByTheater;
use Yeremi\Ingresso\Domain\ValueObject\ShowtimeDates;

interface SessionsRepositoryInterface
{
    public function fetchOne(string $id): ?GenericSession;

    public function fetchByCityAndTheater(): ?ShowtimeByTheater;

    /** @return null|ShowTimeByMovie[] */
    public function fetchByCityAndEvent(string $eventId): ?array;

    /** @return null|ShowTimeByMovie[] */
    public function fetchByEventAndPartnership(string $eventId): ?array;

    public function fetchDatedByEvent(string $eventId): ?ShowtimeDates;

    public function fetchSessionExists(string $urlKey): ?Exists;
}
