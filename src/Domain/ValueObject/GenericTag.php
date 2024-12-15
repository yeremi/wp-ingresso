<?php

declare(strict_types=1);

namespace Yeremi\Ingresso\Domain\ValueObject;

use Yeremi\SchemaMapper\Attributes\ApiSchema;

class GenericTag
{
    public function __construct(
        #[ApiSchema('name')]
        private readonly string $name = '',
        #[ApiSchema('background')]
        private readonly string $background = '',
        #[ApiSchema('color')]
        private readonly string $color = '',
    ) {
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getBackground(): string
    {
        return $this->background;
    }

    public function getColor(): string
    {
        return $this->color;
    }
}
