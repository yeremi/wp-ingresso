<?php

declare(strict_types=1);

namespace Yeremi\Ingresso\Domain\Repositories;

use Yeremi\Ingresso\Domain\ValueObject\Event;
use Yeremi\Ingresso\Domain\ValueObject\EventList;

interface EventsRepositoryInterface
{
    public function fetchOne(string $id): ?Event;

    public function fetchAllAvailable(): ?EventList;

    public function fetchAllByCity(): ?EventList;

    public function fetchComingSoon(): ?EventList;
}
