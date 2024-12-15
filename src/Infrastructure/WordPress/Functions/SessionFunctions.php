<?php

declare(strict_types=1);

namespace Yeremi\Ingresso\Infrastructure\WordPress\Functions;

use Yeremi\Ingresso\Domain\ValueObject\ShowTimeByMovie;
use Yeremi\Ingresso\Infrastructure\WordPress\FilterName;

class SessionFunctions
{
    use FilterName;

    public static function getSessionEventPartnership(): array
    {
        if (has_filter(self::FILTER_SESSION_BY_EVENT_PARTNERSHIP)) {
            $eventId = (string) get_query_var('film_id');
            /** @var ShowTimeByMovie[] $response */
            $response = apply_filters(self::FILTER_SESSION_BY_EVENT_PARTNERSHIP, $eventId);
            return $response;
        }

        return [];
    }

    public static function sessionExists(string $urlKey): bool
    {
        if (has_filter(self::FILTER_SESSION_EXISTS)) {
            return (bool) apply_filters(self::FILTER_SESSION_EXISTS, $urlKey);
        }

        return false;
    }
}
