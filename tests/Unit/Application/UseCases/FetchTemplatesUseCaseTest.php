<?php

declare(strict_types=1);

namespace Yeremi\Ingresso\Tests\Unit\Application\UseCases;

use PHPUnit\Framework\TestCase;
use Yeremi\Ingresso\Application\UseCases\FetchTemplatesUseCase;
use Yeremi\Ingresso\Domain\Repositories\TemplatesRepositoryInterface;
use Yeremi\Ingresso\Domain\ValueObject\EventList;
use Yeremi\Ingresso\Domain\ValueObject\Highlight;

/**
 * @covers \Yeremi\Ingresso\Application\UseCases\FetchTemplatesUseCase
 */
class FetchTemplatesUseCaseTest extends TestCase
{
    /**
     * @dataProvider eventListMethodsProvider
     */
    public function testEventListMethodsReturnRepositoryResult(string $method): void
    {
        $eventList = new EventList();
        $repository = $this->createMock(TemplatesRepositoryInterface::class);
        $repository->expects($this->once())
            ->method($method)
            ->willReturn($eventList);

        $useCase = new FetchTemplatesUseCase($repository);

        $this->assertSame($eventList, $useCase->{$method}());
    }

    /**
     * @dataProvider eventListMethodsProvider
     */
    public function testEventListMethodsReturnEmptyListWhenRepositoryReturnsNull(string $method): void
    {
        $repository = $this->createMock(TemplatesRepositoryInterface::class);
        $repository->method($method)->willReturn(null);

        $useCase = new FetchTemplatesUseCase($repository);

        $this->assertEquals(new EventList(), $useCase->{$method}());
    }

    /**
     * @return array<string, array{string}>
     */
    public static function eventListMethodsProvider(): array
    {
        return [
            'soon' => ['getSoon'],
            'now playing' => ['getNowPlayingByCityAndPartnership'],
        ];
    }

    public function testGetHighlightsReturnsRepositoryResult(): void
    {
        $highlights = [new Highlight()];
        $repository = $this->createMock(TemplatesRepositoryInterface::class);
        $repository->method('getHighlightsByCityAndPartnership')->willReturn($highlights);

        $useCase = new FetchTemplatesUseCase($repository);

        $this->assertSame($highlights, $useCase->getHighlightsByCityAndPartnership());
    }

    public function testGetHighlightsReturnsEmptyArrayWhenRepositoryReturnsNothing(): void
    {
        $repository = $this->createMock(TemplatesRepositoryInterface::class);
        $repository->method('getHighlightsByCityAndPartnership')->willReturn([]);

        $useCase = new FetchTemplatesUseCase($repository);

        $this->assertSame([], $useCase->getHighlightsByCityAndPartnership());
    }
}
