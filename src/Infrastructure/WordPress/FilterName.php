<?php

declare(strict_types=1);

namespace Yeremi\Ingresso\Infrastructure\WordPress;

trait FilterName
{
    public const FILTER_TEMPLATE_SOON = 'ingresso_templates_get_soon';
    public const FILTER_TEMPLATE_NOWPLAYING_CITY_PARTNERSHIP = 'ingresso_templates_get_nowplaying_by_city_and_partnership';
    public const FILTER_TEMPLATE_HIGHLIGHTS_CITY_PARTNERSHIP = 'ingresso_templates_get_highlights_by_city_and_partnership';

    public const FILTER_EVENT_ALL_AVAILABLE = 'ingresso_event_all_available';
    public const FILTER_EVENT_POSTER = 'ingresso_event_poster';
    public const FILTER_EVENT_TRAILER = 'ingresso_event_trailer';
    public const FILTER_EVENT_GET_ONE = 'ingresso_event_get_one';

    public const FILTER_SESSION_ONE = 'ingresso_session_get_one';
    public const FILTER_SESSION_BY_CITY_EVENT = 'ingresso_session_get_by_city_event';
    public const FILTER_SESSION_BY_EVENT_PARTNERSHIP = 'ingresso_session_get_by_event_partnership';
    public const FILTER_SESSION_EXISTS = 'ingresso_session_exists';

    public const FILTER_PASSPORT_PROMOTION = 'ingresso_passport_promotion';
}
