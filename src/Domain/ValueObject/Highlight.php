<?php

declare(strict_types=1);

namespace Yeremi\Ingresso\Domain\ValueObject;

use Yeremi\SchemaMapper\Attributes\ApiSchema;

class Highlight
{
    public function __construct(
        #[ApiSchema('event', Event::class)]
        private readonly ?Event $event = null,
        #[ApiSchema('showtimes', SimplifiedTheater::class, true)]
        private readonly array $showtimes = [],
    ) {
    }

    public function getEvent(): ?Event
    {
        return $this->event;
    }

    public function getShowtimes(): array
    {
        return $this->showtimes;
    }
}
