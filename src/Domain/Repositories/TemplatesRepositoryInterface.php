<?php

declare(strict_types=1);

namespace Yeremi\Ingresso\Domain\Repositories;

use Yeremi\Ingresso\Domain\ValueObject\EventList;

interface TemplatesRepositoryInterface
{
    public function getSoon(): ?EventList;

    public function getNowPlayingByCityAndPartnership(): ?EventList;

    public function getHighlightsByCityAndPartnership(): array;
}
