<?php

declare(strict_types=1);

namespace Yeremi\Ingresso\Domain\ValueObject;

use Yeremi\SchemaMapper\Attributes\ApiSchema;

class Trailer
{
    public function __construct(
        #[ApiSchema('url')]
        private readonly string $url = '',
        #[ApiSchema('type')]
        private readonly string $type = '',
        #[ApiSchema('embeddedUrl')]
        private readonly string $embeddedUrl = '',
    ) {
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getEmbeddedUrl(): string
    {
        return $this->embeddedUrl;
    }
}
