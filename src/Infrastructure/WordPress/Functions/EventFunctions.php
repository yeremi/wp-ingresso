<?php

declare(strict_types=1);

namespace Yeremi\Ingresso\Infrastructure\WordPress\Functions;

use Yeremi\Ingresso\Domain\ValueObject\Event;
use Yeremi\Ingresso\Domain\ValueObject\EventList;
use Yeremi\Ingresso\Domain\ValueObject\ImageType;
use Yeremi\Ingresso\Domain\ValueObject\Trailer;
use Yeremi\Ingresso\Infrastructure\WordPress\FilterName;

class EventFunctions
{
    use FilterName;

    /**
     * @return array|EventList
     */
    public static function getAllMovies(): array|EventList
    {
        if (has_filter(self::FILTER_EVENT_ALL_AVAILABLE)) {
            /** @var EventList $response */
            $response = apply_filters(self::FILTER_EVENT_ALL_AVAILABLE, false);
            return $response;
        }

        return [];
    }

    public static function getPoster(Event $event, ImageType $imageType = ImageType::POSTER_PORTRAIT): string
    {
        if (has_filter(self::FILTER_EVENT_POSTER)) {
            return (string) apply_filters(self::FILTER_EVENT_POSTER, $event, $imageType);
        }

        return '';
    }

    public static function getTrailers(string $movie): array
    {
        if (has_filter(self::FILTER_EVENT_TRAILER)) {
            /** @var Trailer[] $response */
            $response = apply_filters(self::FILTER_EVENT_TRAILER, $movie);
            return $response;
        }

        return [];
    }

    public static function getOne(): Event
    {
        if (has_filter(self::FILTER_EVENT_GET_ONE)) {
            $eventId = (string) get_query_var('film_id');

            /** @var Event $response */
            $response = apply_filters(self::FILTER_EVENT_GET_ONE, $eventId);
            return $response;
        }

        return new Event();
    }
}
