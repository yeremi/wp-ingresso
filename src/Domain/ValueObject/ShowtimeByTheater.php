<?php

declare(strict_types=1);

namespace Yeremi\Ingresso\Domain\ValueObject;

use Yeremi\SchemaMapper\Attributes\ApiSchema;

class ShowtimeByTheater
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
        #[ApiSchema('movies', ShowtimeByTheaterEvent::class)]
        private readonly array $movies = [],
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

    public function getMovies(): array
    {
        return $this->movies;
    }
}
