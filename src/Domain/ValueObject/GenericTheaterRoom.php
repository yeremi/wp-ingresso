<?php

declare(strict_types=1);

namespace Yeremi\Ingresso\Domain\ValueObject;

use Yeremi\SchemaMapper\Attributes\ApiSchema;

class GenericTheaterRoom
{
    public function __construct(
        #[ApiSchema('name')]
        private readonly string $name = '',
        #[ApiSchema('type')]
        private readonly ?array $type = [],
        #[ApiSchema('sessions', GenericSession::class, isArray: true)]
        private readonly array $genericSession = [],
    ) {
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getType(): ?array
    {
        return $this->type ?? [];
    }

    public function getSessions(): array
    {
        return $this->genericSession;
    }
}
