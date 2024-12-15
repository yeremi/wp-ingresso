<?php

declare(strict_types=1);

namespace Yeremi\Ingresso\Domain\ValueObject;

use Yeremi\SchemaMapper\Attributes\ApiSchema;

class ShowTimeByMovie
{
    public function __construct(
        #[ApiSchema('date')]
        private readonly string $date = '',
        #[ApiSchema('dateFormatted')]
        private readonly string $dateFormatted = '',
        #[ApiSchema('dayOfWeek')]
        private readonly string $dayOfWeek = '',
        #[ApiSchema('isToday')]
        private readonly bool $isToday = false,
        #[ApiSchema('theaters', SimplifiedTheater::class, isArray: true)]
        private readonly array $theaters = [],
    ) {
    }

    public function getDate(): string
    {
        return $this->date;
    }

    public function getDateFormatted(): string
    {
        return $this->dateFormatted;
    }

    public function getDayOfWeek(): string
    {
        return $this->dayOfWeek;
    }

    public function isToday(): bool
    {
        return $this->isToday;
    }

    public function getTheaters(): array
    {
        return $this->theaters;
    }
}
