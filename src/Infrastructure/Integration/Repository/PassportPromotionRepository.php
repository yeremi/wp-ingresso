<?php

declare(strict_types=1);

namespace Yeremi\Ingresso\Infrastructure\Integration\Repository;

use Yeremi\Ingresso\Domain\Repositories\PassportPromotionRepositoryInterface;
use Yeremi\RouteMapper\Attribute\ApiRoute;

class PassportPromotionRepository extends AbstractRepository implements PassportPromotionRepositoryInterface
{
    #[ApiRoute('/passport-promotion')]
    public function fetchPassportPromotion(): array
    {
        return [];
    }
}
