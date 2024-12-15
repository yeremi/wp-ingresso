<?php

declare(strict_types=1);

namespace Yeremi\Ingresso\Domain\ValueObject;

use Yeremi\SchemaMapper\Attributes\ApiSchema;

class GenericSessionSessionType
{
    public function __construct(
        #[ApiSchema('id')]
        private readonly int $id = 0,
        #[ApiSchema('name')]
        private readonly string $name = '',
        #[ApiSchema('alias')]
        private readonly string $alias = '',
        #[ApiSchema('display')]
        private readonly bool $display = false,
        #[ApiSchema('typeDescriptions', TypeDescription::class)]
        private readonly ?TypeDescription $typeDescriptions = null,
    ) {
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getAlias(): string
    {
        return $this->alias;
    }

    public function isDisplay(): bool
    {
        return $this->display;
    }

    public function getTypeDescriptions(): ?TypeDescription
    {
        return $this->typeDescriptions;
    }
}
