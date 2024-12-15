<?php

declare(strict_types=1);

namespace Yeremi\Ingresso\Domain\ValueObject;

use Yeremi\SchemaMapper\Attributes\ApiSchema;

class OperationPolicy
{
    public function __construct(
        #[ApiSchema('categoryId')]
        private readonly string $categoryId = '',
        #[ApiSchema('categoryName')]
        private readonly string $categoryName = '',
        #[ApiSchema('categoryDescription')]
        private readonly string $categoryDescription = '',
        #[ApiSchema('categoryIconUrl')]
        private readonly string $categoryIconUrl = '',
        #[ApiSchema('categoryType')]
        private readonly string $categoryType = '',
        #[ApiSchema('policyId')]
        private readonly int $policyId = 0,
        #[ApiSchema('policyDescription')]
        private readonly string $policyDescription = '',
    ) {
    }

    public function getCategoryId(): string
    {
        return $this->categoryId;
    }

    public function getCategoryName(): string
    {
        return $this->categoryName;
    }

    public function getCategoryDescription(): string
    {
        return $this->categoryDescription;
    }

    public function getCategoryIconUrl(): string
    {
        return $this->categoryIconUrl;
    }

    public function getCategoryType(): string
    {
        return $this->categoryType;
    }

    public function getPolicyId(): int
    {
        return $this->policyId;
    }

    public function getPolicyDescription(): string
    {
        return $this->policyDescription;
    }
}
