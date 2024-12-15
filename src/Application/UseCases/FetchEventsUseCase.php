<?php

declare(strict_types=1);

namespace Yeremi\Ingresso\Application\UseCases;

use Yeremi\Ingresso\Domain\Repositories\EventsRepositoryInterface;
use Yeremi\Ingresso\Domain\ValueObject\Event;
use Yeremi\Ingresso\Domain\ValueObject\EventList;

class FetchEventsUseCase
{
    use UseCaseTrait;

    public function __construct(
        private readonly EventsRepositoryInterface $eventsRepository
    ) {
    }

    public function getOne(string $eventId): Event
    {
        $result = $this->eventsRepository->fetchOne($eventId);
        if (!$result instanceof Event) {
            return new Event();
        }

        return $result;
    }

    public function getAllAvailable(): EventList
    {
        $result = $this->eventsRepository->fetchAllAvailable();
        if (!$result instanceof EventList) {
            return new EventList();
        }

        return $result;
    }

    public function getAllByCity(): EventList
    {
        $result = $this->eventsRepository->fetchAllByCity();
        if (!$result instanceof EventList) {
            return new EventList();
        }

        return $result;
    }

    public function getComingSoon(): EventList
    {
        $result = $this->eventsRepository->fetchComingSoon();
        if (!$result instanceof EventList) {
            return new EventList();
        }

        return $result;
    }
}
