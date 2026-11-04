<?php

declare(strict_types=1);

namespace Yeremi\Ingresso\Tests\Unit\Infrastructure\Integration\Repository;

use Yeremi\Ingresso\Domain\ValueObject\EventList;
use Yeremi\Ingresso\Domain\ValueObject\Highlight;
use Yeremi\Ingresso\Infrastructure\Integration\Repository\TemplatesRepository;

/**
 * @covers \Yeremi\Ingresso\Infrastructure\Integration\Repository\TemplatesRepository
 * @covers \Yeremi\Ingresso\Infrastructure\Integration\Repository\AbstractRepository
 */
class TemplatesRepositoryTest extends RepositoryTestCase
{
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

        $repository = $this->createRepository(TemplatesRepository::class, $response);

        $this->assertSame($eventList, $repository->{$method}());
        $this->assertRequestedEndpoint($endpoint);
    }

    /**
     * @dataProvider eventListMethodsProvider
     */
    public function testEventListMethodsReturnNullOnEmptyResponse(string $method): void
    {
        $this->normalizer->expects($this->never())->method('normalize');

        $repository = $this->createRepository(TemplatesRepository::class, []);

        $this->assertNull($repository->{$method}());
    }

    /**
     * @return array<string, array{string, string}>
     */
    public static function eventListMethodsProvider(): array
    {
        return [
            'soon' => [
                'getSoon',
                '/templates/soon/' . self::CITY_ID . '/partnership/' . self::PARTNERSHIP,
            ],
            'now playing' => [
                'getNowPlayingByCityAndPartnership',
                '/templates/nowplaying/' . self::CITY_ID . '/partnership/' . self::PARTNERSHIP,
            ],
        ];
    }

    public function testGetHighlightsNormalizesEachItem(): void
    {
        $highlight = new Highlight();
        $this->normalizer->expects($this->once())
            ->method('normalize')
            ->with(['id' => 'h1'], Highlight::class)
            ->willReturn($highlight);

        $repository = $this->createRepository(TemplatesRepository::class, [['id' => 'h1']]);

        $this->assertSame([$highlight], $repository->getHighlightsByCityAndPartnership());
        $this->assertRequestedEndpoint(
            '/templates/highlights/' . self::CITY_ID . '/partnership/' . self::PARTNERSHIP
            . '?theatersIds=' . self::THEATER_ID
        );
    }

    public function testGetHighlightsReturnsEmptyArrayOnEmptyResponse(): void
    {
        $this->normalizer->expects($this->never())->method('normalize');

        $repository = $this->createRepository(TemplatesRepository::class, []);

        $this->assertSame([], $repository->getHighlightsByCityAndPartnership());
    }
}
