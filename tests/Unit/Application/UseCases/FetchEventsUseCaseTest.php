<?php

declare(strict_types=1);

namespace Yeremi\Ingresso\Tests\Unit\Application\UseCases;

use PHPUnit\Framework\TestCase;
use Yeremi\Ingresso\Application\UseCases\FetchEventsUseCase;
use Yeremi\Ingresso\Domain\Repositories\EventsRepositoryInterface;
use Yeremi\Ingresso\Domain\ValueObject\Event;
use Yeremi\Ingresso\Domain\ValueObject\EventList;

/**
 * @covers \Yeremi\Ingresso\Application\UseCases\FetchEventsUseCase
 */
class FetchEventsUseCaseTest extends TestCase
{
    public function testGetOneReturnsRepositoryEvent(): void
    {
        $event = new Event();
        $repository = $this->createMock(EventsRepositoryInterface::class);
        $repository->expects($this->once())
            ->method('fetchOne')
            ->with('event-1')
            ->willReturn($event);

        $useCase = new FetchEventsUseCase($repository);

        $this->assertSame($event, $useCase->getOne('event-1'));
    }

    public function testGetOneReturnsEmptyEventWhenRepositoryReturnsNull(): void
    {
        $repository = $this->createMock(EventsRepositoryInterface::class);
        $repository->method('fetchOne')->willReturn(null);

        $useCase = new FetchEventsUseCase($repository);

        $this->assertEquals(new Event(), $useCase->getOne('missing'));
    }

    /**
     * @dataProvider eventListMethodsProvider
     */
    public function testEventListMethodsReturnRepositoryResult(
        string $useCaseMethod,
        string $repositoryMethod
    ): void {

        $eventList = new EventList();
        $repository = $this->createMock(EventsRepositoryInterface::class);
        $repository->expects($this->once())
            ->method($repositoryMethod)
            ->willReturn($eventList);

        $useCase = new FetchEventsUseCase($repository);

        $this->assertSame($eventList, $useCase->{$useCaseMethod}());
    }

    /**
     * @dataProvider eventListMethodsProvider
     */
    public function testEventListMethodsReturnEmptyListWhenRepositoryReturnsNull(
        string $useCaseMethod,
        string $repositoryMethod
    ): void {

        $repository = $this->createMock(EventsRepositoryInterface::class);
        $repository->method($repositoryMethod)->willReturn(null);

        $useCase = new FetchEventsUseCase($repository);

        $this->assertEquals(new EventList(), $useCase->{$useCaseMethod}());
    }

    /**
     * @return array<string, array{string, string}>
     */
    public static function eventListMethodsProvider(): array
    {
        return [
            'all available' => ['getAllAvailable', 'fetchAllAvailable'],
            'all by city' => ['getAllByCity', 'fetchAllByCity'],
            'coming soon' => ['getComingSoon', 'fetchComingSoon'],
        ];
    }
}
