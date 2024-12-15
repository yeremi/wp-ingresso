<?php

declare(strict_types=1);

namespace Yeremi\Ingresso\Domain\ValueObject;

use Yeremi\SchemaMapper\Attributes\ApiSchema;

class GenericTheaterSessionType
{
    public function __construct(
        #[ApiSchema('type')]
        private readonly string $type = '',
        #[ApiSchema('sessions', GenericSession::class)]
        private readonly array $genericSession = [],
    ) {
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getGenericSession(): array
    {
        return $this->genericSession;
    }
}
