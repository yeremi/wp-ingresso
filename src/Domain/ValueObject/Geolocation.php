<?php

declare(strict_types=1);

namespace Yeremi\Ingresso\Domain\ValueObject;

use Yeremi\SchemaMapper\Attributes\ApiSchema;

class Geolocation
{
    public function __construct(
        #[ApiSchema('lat')]
        private readonly float $lat = 0.0,
        #[ApiSchema('lng')]
        private readonly float $lng = 0.0,
    ) {
    }

    public function getLat(): float
    {
        return $this->lat;
    }

    public function getLng(): float
    {
        return $this->lng;
    }
}
