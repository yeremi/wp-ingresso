<?php

declare(strict_types=1);

namespace Yeremi\Ingresso\Infrastructure\WordPress\Filters;

use Yeremi\Ingresso\Application\UseCases\FetchTemplatesUseCase;
use Yeremi\Ingresso\Domain\ValueObject\EventList;
use Yeremi\Ingresso\Infrastructure\WordPress\FilterName;

class TemplatesHookHandler
{
    use FilterName;

    public function __construct(
        private readonly FetchTemplatesUseCase $templatesUseCase,
    ) {

        add_filter(self::FILTER_TEMPLATE_SOON, $this->filterSoon(...));
        add_filter(self::FILTER_TEMPLATE_NOWPLAYING_CITY_PARTNERSHIP, $this->getNowPlaying(...));
        add_filter(self::FILTER_TEMPLATE_HIGHLIGHTS_CITY_PARTNERSHIP, $this->getHighlights(...));
    }

    public function filterSoon(): EventList
    {
        return $this->templatesUseCase->getSoon();
    }

    public function getNowPlaying(): EventList
    {
        return $this->templatesUseCase->getNowPlayingByCityAndPartnership();
    }

    public function getHighlights(): array
    {
        return $this->templatesUseCase->getHighlightsByCityAndPartnership();
    }
}
