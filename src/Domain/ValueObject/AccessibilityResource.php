<?php

declare(strict_types=1);

namespace Yeremi\Ingresso\Domain\ValueObject;

use Yeremi\SchemaMapper\Attributes\ApiSchema;

class AccessibilityResource
{
    public function __construct(
        #[ApiSchema('name')]
        private readonly string $name = '',
        #[ApiSchema('imageUrl')]
        private readonly string $imageUrl = '',
        #[ApiSchema('imageAltText')]
        private readonly string $imageAltText = '',
    ) {
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getImageUrl(): string
    {
        return $this->imageUrl;
    }

    public function getImageAltText(): string
    {
        return $this->imageAltText;
    }
}
