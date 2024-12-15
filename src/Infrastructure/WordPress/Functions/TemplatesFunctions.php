<?php

declare(strict_types=1);

namespace Yeremi\Ingresso\Infrastructure\WordPress\Functions;

use Yeremi\Ingresso\Domain\ValueObject\EventList;
use Yeremi\Ingresso\Domain\ValueObject\Highlight;
use Yeremi\Ingresso\Infrastructure\WordPress\FilterName;

class TemplatesFunctions
{
    use FilterName;

    /**
     * @return array|EventList
     */
    public static function getSoon(): array|EventList
    {
        if (has_filter(self::FILTER_TEMPLATE_SOON)) {
            /** @var EventList $response */
            $response = apply_filters(self::FILTER_TEMPLATE_SOON, false);
            return $response->getItems();
        }

        return [];
    }

    /**
     * @return array|EventList
     */
    public static function getNowPlayingByCityAndPartnership(): array|EventList
    {

        if (has_filter(self::FILTER_TEMPLATE_NOWPLAYING_CITY_PARTNERSHIP)) {
            /** @var EventList $response */
            $response = apply_filters(self::FILTER_TEMPLATE_NOWPLAYING_CITY_PARTNERSHIP, false);
            return $response->getItems();
        }

        return [];
    }

    /**
     * @return array|Highlight
     */
    public static function getHighlightsByCityAndPartnership(): array|Highlight
    {

        if (has_filter(self::FILTER_TEMPLATE_HIGHLIGHTS_CITY_PARTNERSHIP)) {
            /** @var Highlight $response */
            $response = apply_filters(self::FILTER_TEMPLATE_HIGHLIGHTS_CITY_PARTNERSHIP, false);
            return $response;
        }

        return [];
    }
}
