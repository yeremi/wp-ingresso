<?php

declare(strict_types=1);

namespace Yeremi\Ingresso\Domain\Repositories;

interface PassportPromotionRepositoryInterface
{
    public function fetchPassportPromotion(): array;
}
