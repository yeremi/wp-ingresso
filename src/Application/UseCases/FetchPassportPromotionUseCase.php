<?php

declare(strict_types=1);

namespace Yeremi\Ingresso\Application\UseCases;

use Yeremi\Ingresso\Domain\Repositories\PassportPromotionRepositoryInterface;

class FetchPassportPromotionUseCase
{
    use UseCaseTrait;

    public function __construct(
        private readonly PassportPromotionRepositoryInterface $passportPromotionRepository
    ) {
    }

    public function getPassportPromotion(): array
    {
        return $this->passportPromotionRepository->fetchPassportPromotion();
    }
}
