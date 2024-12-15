<?php

declare(strict_types=1);

namespace Yeremi\Ingresso\Infrastructure\WordPress\Filters;

use Yeremi\Ingresso\Application\UseCases\FetchEventsUseCase;
use Yeremi\Ingresso\Domain\ValueObject\Event;
use Yeremi\Ingresso\Domain\ValueObject\EventList;
use Yeremi\Ingresso\Domain\ValueObject\Image;
use Yeremi\Ingresso\Domain\ValueObject\ImageType;
use Yeremi\Ingresso\Domain\ValueObject\Trailer;
use Yeremi\Ingresso\Infrastructure\WordPress\FilterName;

class EventsHookHandler
{
    use FilterName;

    public function __construct(
        private readonly FetchEventsUseCase $fetchEventsUseCase,
    ) {

        add_filter(self::FILTER_EVENT_ALL_AVAILABLE, $this->filterAllMovies(...));
        add_filter(self::FILTER_EVENT_POSTER, $this->filterPosterPortrait(...), 10, 2);
        add_filter(self::FILTER_EVENT_TRAILER, $this->filterTrailers(...));
        add_filter(self::FILTER_EVENT_GET_ONE, $this->filterOne(...));
    }

    /**
     * @return EventList
     */
    public function filterAllMovies(): EventList
    {
        return $this->fetchEventsUseCase->getAllAvailable();
    }

    public function filterPosterPortrait(
        Event $event,
        ImageType $imageType = ImageType::POSTER_PORTRAIT
    ): string {

        $images = $event->getImages();
        if ($images) {
            $posterPortrait = array_filter($images, static fn (Image $image): bool => $image->getType() === $imageType->value);
            $firstPosterUrl = !empty($posterPortrait) ? array_shift($posterPortrait) : null;
            if (!is_null($firstPosterUrl)) {
                /** @var Image $firstPosterUrl */
                return $firstPosterUrl->getUrl();
            }
        }

        return '';
    }

    public function filterTrailers(Event $eventDto): array
    {
        $trailers = $eventDto->getTrailers();
        if ($trailers !== []) {
            /** @var Trailer[] $trailers */
            return $trailers;
        }

        return [];
    }

    public function filterOne(string $eventId): ?Event
    {
        return $this->fetchEventsUseCase->getOne($eventId);
    }
}
