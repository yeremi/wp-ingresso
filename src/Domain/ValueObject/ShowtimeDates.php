<?php

declare(strict_types=1);

namespace Yeremi\Ingresso\Domain\ValueObject;

use Yeremi\SchemaMapper\Attributes\ApiSchema;

class ShowtimeDates
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
        #[ApiSchema('sessionTypes')]
        private readonly array $sessionTypes = []
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

    public function getSessionTypes(): array
    {
        return $this->sessionTypes;
    }
}
