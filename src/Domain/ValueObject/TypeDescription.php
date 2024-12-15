<?php

declare(strict_types=1);

namespace Yeremi\Ingresso\Domain\ValueObject;

use Yeremi\SchemaMapper\Attributes\ApiSchema;

class TypeDescription
{
    public function __construct(
        #[ApiSchema('summaryDescription')]
        private readonly string $summaryDescription = '',
        #[ApiSchema('summaryImage')]
        private readonly string $summaryImage = '',
        #[ApiSchema('detailedDescription')]
        private readonly string $detailedDescription = '',
        #[ApiSchema('detailedImage')]
        private readonly string $detailedImage = '',
    ) {
    }

    public function getSummaryDescription(): string
    {
        return $this->summaryDescription;
    }

    public function getSummaryImage(): string
    {
        return $this->summaryImage;
    }

    public function getDetailedDescription(): string
    {
        return $this->detailedDescription;
    }

    public function getDetailedImage(): string
    {
        return $this->detailedImage;
    }
}
