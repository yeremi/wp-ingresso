<?php

declare(strict_types=1);

namespace Yeremi\Ingresso\Domain\ValueObject;

use Yeremi\SchemaMapper\Attributes\ApiSchema;

class GenericTheaterSession
{
    public function __construct(
        #[ApiSchema('type')]
        private readonly string $type = '',
        #[ApiSchema('sessions', GenericSession::class, isArray: true)]
        private readonly array $genericSession = [],
    ) {
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getSessions(): array
    {
        return $this->genericSession;
    }
}
