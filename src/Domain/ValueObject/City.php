<?php

declare(strict_types=1);

namespace Yeremi\Ingresso\Domain\ValueObject;

use Yeremi\SchemaMapper\Attributes\ApiSchema;

class City
{
    public function __construct(
        #[ApiSchema('id')]
        private readonly string $id = '',
        #[ApiSchema('name')]
        private readonly string $name = '',
	    // phpcs:disable Inpsyde.CodeQuality.ElementNameMinimalLength
        #[ApiSchema('uf')]
        private readonly string $uf = '',
        #[ApiSchema('state')]
        private readonly string $state = '',
        #[ApiSchema('urlKey')]
        private readonly string $urlKey = '',
        #[ApiSchema('timeZone')]
        private readonly string $timeZone = '',
    ) {
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getUf(): string
    {
        return $this->uf;
    }

    public function getState(): string
    {
        return $this->state;
    }

    public function getUrlKey(): string
    {
        return $this->urlKey;
    }

    public function getTimeZone(): string
    {
        return $this->timeZone;
    }
}
