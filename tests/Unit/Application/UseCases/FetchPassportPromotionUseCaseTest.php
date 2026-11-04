<?php

declare(strict_types=1);

namespace Yeremi\Ingresso\Tests\Unit\Application\UseCases;

use PHPUnit\Framework\TestCase;
use Yeremi\Ingresso\Application\UseCases\FetchPassportPromotionUseCase;
use Yeremi\Ingresso\Domain\Repositories\PassportPromotionRepositoryInterface;

/**
 * @covers \Yeremi\Ingresso\Application\UseCases\FetchPassportPromotionUseCase
 */
class FetchPassportPromotionUseCaseTest extends TestCase
{
    public function testGetPassportPromotionReturnsRepositoryResult(): void
    {
        $promotion = ['title' => 'Passport'];
        $repository = $this->createMock(PassportPromotionRepositoryInterface::class);
        $repository->expects($this->once())
            ->method('fetchPassportPromotion')
            ->willReturn($promotion);

        $useCase = new FetchPassportPromotionUseCase($repository);

        $this->assertSame($promotion, $useCase->getPassportPromotion());
    }
}
