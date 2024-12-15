<?php

declare(strict_types=1);

namespace Yeremi\Ingresso\Infrastructure\WordPress\Filters;

use Yeremi\Ingresso\Application\UseCases\FetchPassportPromotionUseCase;
use Yeremi\Ingresso\Infrastructure\WordPress\FilterName;

class PassportPromotionHookHandler
{
    use FilterName;

    public function __construct(
        private readonly FetchPassportPromotionUseCase $fetchPassportPromotionUseCase,
    ) {

        add_filter(self::FILTER_PASSPORT_PROMOTION, $this->filterPassportPromotion(...));
    }

    public function filterPassportPromotion(): array
    {
        return $this->fetchPassportPromotionUseCase->getPassportPromotion();
    }
}
