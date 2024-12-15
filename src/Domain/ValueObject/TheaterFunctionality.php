<?php

declare(strict_types=1);

namespace Yeremi\Ingresso\Domain\ValueObject;

use Yeremi\SchemaMapper\Attributes\ApiSchema;

class TheaterFunctionality
{
    public function __construct(
        #[ApiSchema('operationPolicyEnabled')]
        private readonly bool $operationPolicyEnabled = false,
    ) {
    }

    public function isOperationPolicyEnabled(): bool
    {
        return $this->operationPolicyEnabled;
    }
}
