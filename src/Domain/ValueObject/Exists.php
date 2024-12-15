<?php

declare(strict_types=1);

namespace Yeremi\Ingresso\Domain\ValueObject;

use Yeremi\SchemaMapper\Attributes\ApiSchema;

class Exists
{
    public function __construct(
        #[ApiSchema('type')]
        private readonly string $type = '',
        #[ApiSchema('title')]
        private readonly string $title = '',
        #[ApiSchema('status')]
        private readonly int $status = 0,
        #[ApiSchema('traceId')]
        private readonly string $traceId = '',
    ) {
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getStatus(): int
    {
        return $this->status;
    }

    public function getTraceId(): string
    {
        return $this->traceId;
    }
}
