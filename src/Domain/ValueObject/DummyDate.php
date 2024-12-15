<?php

declare(strict_types=1);

namespace Yeremi\Ingresso\Domain\ValueObject;

use Yeremi\SchemaMapper\Attributes\ApiSchema;

class DummyDate
{
    public function __construct(
        #[ApiSchema('localDate')]
        private readonly string $localDate = '',
        #[ApiSchema('isToday')]
        private readonly bool $isToday = false,
        #[ApiSchema('dayOfWeek')]
        private readonly string $dayOfWeek = '',
        #[ApiSchema('dayAndMonth')]
        private readonly string $dayAndMonth = '',
        #[ApiSchema('hour')]
        private readonly string $hour = '',
        #[ApiSchema('year')]
        private readonly string $year = '',
    ) {
    }

    public function getLocalDate(): string
    {
        return $this->localDate;
    }

    public function isToday(): bool
    {
        return $this->isToday;
    }

    public function getDayOfWeek(): string
    {
        return $this->dayOfWeek;
    }

    public function getDayAndMonth(): string
    {
        return $this->dayAndMonth;
    }

    public function getHour(): string
    {
        return $this->hour;
    }

    public function getYear(): string
    {
        return $this->year;
    }
}
