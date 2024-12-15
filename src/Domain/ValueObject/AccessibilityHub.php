<?php

declare(strict_types=1);

namespace Yeremi\Ingresso\Domain\ValueObject;

use Yeremi\SchemaMapper\Attributes\ApiSchema;

class AccessibilityHub
{
    public function __construct(
        #[ApiSchema('name')]
        private readonly string $name = '',
        #[ApiSchema('description')]
        private readonly string $description = '',
        #[ApiSchema('url')]
        private readonly string $url = '',
        #[ApiSchema('resources', AccessibilityResource::class, isArray: true)]
        private readonly array $resources = [],
    ) {
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function getResources(): array
    {
        return $this->resources;
    }
}
