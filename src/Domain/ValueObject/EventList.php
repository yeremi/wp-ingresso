<?php

declare(strict_types=1);

namespace Yeremi\Ingresso\Domain\ValueObject;

use Yeremi\SchemaMapper\Attributes\ApiSchema;

class EventList
{
    public function __construct(
        #[ApiSchema('items', Event::class, isArray: true)]
        private readonly array $items = [],
        #[ApiSchema('count')]
        private readonly int $count = 0,
    ) {
    }

    public function getItems(): array
    {
        return $this->items;
    }

    public function getCount(): int
    {
        return $this->count;
    }
}
