<?php

declare(strict_types=1);

namespace Yeremi\Ingresso\Application\UseCases;

use Yeremi\Ingresso\Domain\Repositories\TemplatesRepositoryInterface;
use Yeremi\Ingresso\Domain\ValueObject\EventList;

class FetchTemplatesUseCase
{
    public function __construct(
        private readonly TemplatesRepositoryInterface $templatesRepository,
    ) {
    }

    public function getSoon(): EventList
    {
        $result = $this->templatesRepository->getSoon();
        if (!$result instanceof EventList) {
            return new EventList();
        }

        return $result;
    }

    public function getNowPlayingByCityAndPartnership(): EventList
    {

        $result = $this->templatesRepository->getNowPlayingByCityAndPartnership();
        if (!$result instanceof EventList) {
            return new EventList();
        }

        return $result;
    }

    public function getHighlightsByCityAndPartnership(): array
    {

        $result = $this->templatesRepository->getHighlightsByCityAndPartnership();
        if (!$result) {
            return [];
        }

        return $result;
    }
}
