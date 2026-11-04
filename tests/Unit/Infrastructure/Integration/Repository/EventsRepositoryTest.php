<?php

declare(strict_types=1);

namespace Yeremi\Ingresso\Tests\Unit\Infrastructure\Integration\Repository;

use Yeremi\Ingresso\Domain\ValueObject\Event;
use Yeremi\Ingresso\Domain\ValueObject\EventList;
use Yeremi\Ingresso\Infrastructure\Integration\Repository\EventsRepository;

/**
 * @covers \Yeremi\Ingresso\Infrastructure\Integration\Repository\EventsRepository
 * @covers \Yeremi\Ingresso\Infrastructure\Integration\Repository\AbstractRepository
 */
class EventsRepositoryTest extends RepositoryTestCase
{
    public function testFetchOneRequestsEventAndNormalizesResponse(): void
    {
        $response = ['id' => 'event-1'];
        $event = new Event();
        $this->normalizer->expects($this->once())
            ->method('normalize')
            ->with($response, Event::class)
            ->willReturn($event);

        $repository = $this->createRepository(EventsRepository::class, $response);

        $this->assertSame($event, $repository->fetchOne('event-1'));
        $this->assertRequestedEndpoint('/events/event-1/partnership/' . self::PARTNERSHIP);
    }

    /**
     * @dataProvider eventListMethodsProvider
     */
    public function testEventListMethodsRequestExpectedEndpoint(string $method, string $endpoint): void
    {
        $response = ['items' => []];
        $eventList = new EventList();
        $this->normalizer->expects($this->once())
            ->method('normalize')
            ->with($response, EventList::class)
            ->willReturn($eventList);

        $repository = $this->createRepository(EventsRepository::class, $response);

        $this->assertSame($eventList, $repository->{$method}());
        $this->assertRequestedEndpoint($endpoint);
    }

    /**
     * @return array<string, array{string, string}>
     */
    public static function eventListMethodsProvider(): array
    {
        return [
            'all available' => [
                'fetchAllAvailable',
                '/events/partnership/' . self::PARTNERSHIP,
            ],
            'all by city' => [
                'fetchAllByCity',
                '/events/city/' . self::CITY_ID . '/partnership/' . self::PARTNERSHIP,
            ],
            'coming soon' => [
                'fetchComingSoon',
                '/events/coming-soon/partnership/' . self::PARTNERSHIP,
            ],
        ];
    }

    /**
     * @dataProvider emptyResponseMethodsProvider
     */
    public function testReturnsNullOnEmptyResponse(string $method, array $arguments): void
    {
        $this->normalizer->expects($this->never())->method('normalize');

        $repository = $this->createRepository(EventsRepository::class, []);

        $this->assertNull($repository->{$method}(...$arguments));
    }

    /**
     * @return array<string, array{string, array}>
     */
    public static function emptyResponseMethodsProvider(): array
    {
        return [
            'one' => ['fetchOne', ['event-1']],
            'all available' => ['fetchAllAvailable', []],
            'all by city' => ['fetchAllByCity', []],
            'coming soon' => ['fetchComingSoon', []],
        ];
    }
}
