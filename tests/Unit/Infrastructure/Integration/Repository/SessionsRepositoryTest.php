<?php

declare(strict_types=1);

namespace Yeremi\Ingresso\Tests\Unit\Infrastructure\Integration\Repository;

use Yeremi\Ingresso\Domain\ValueObject\Exists;
use Yeremi\Ingresso\Domain\ValueObject\GenericSession;
use Yeremi\Ingresso\Domain\ValueObject\ShowTimeByMovie;
use Yeremi\Ingresso\Domain\ValueObject\ShowtimeByTheater;
use Yeremi\Ingresso\Domain\ValueObject\ShowtimeDates;
use Yeremi\Ingresso\Infrastructure\Integration\Repository\SessionsRepository;

/**
 * @covers \Yeremi\Ingresso\Infrastructure\Integration\Repository\SessionsRepository
 * @covers \Yeremi\Ingresso\Infrastructure\Integration\Repository\AbstractRepository
 */
class SessionsRepositoryTest extends RepositoryTestCase
{
    /**
     * @dataProvider singleObjectMethodsProvider
     */
    public function testSingleObjectMethodsRequestExpectedEndpoint(
        string $method,
        array $arguments,
        string $targetClass,
        string $endpoint
    ): void {

        $response = ['key' => 'value'];
        $normalized = new $targetClass();
        $this->normalizer->expects($this->once())
            ->method('normalize')
            ->with($response, $targetClass)
            ->willReturn($normalized);

        $repository = $this->createRepository(SessionsRepository::class, $response);

        $this->assertSame($normalized, $repository->{$method}(...$arguments));
        $this->assertRequestedEndpoint($endpoint);
    }

    /**
     * @return array<string, array{string, array, class-string, string}>
     */
    public static function singleObjectMethodsProvider(): array
    {
        return [
            'one' => [
                'fetchOne',
                ['session-1'],
                GenericSession::class,
                '/sessions/session-1/partnership/' . self::PARTNERSHIP,
            ],
            'by city and theater' => [
                'fetchByCityAndTheater',
                [],
                ShowtimeByTheater::class,
                '/sessions/city/' . self::CITY_ID . '/theater/' . self::THEATER_ID
                . '/partnership/' . self::PARTNERSHIP,
            ],
            'dated by event' => [
                'fetchDatedByEvent',
                ['event-1'],
                ShowtimeDates::class,
                '/sessions/city/' . self::CITY_ID . '/event/event-1/dates/partnership/'
                . self::PARTNERSHIP,
            ],
            'session exists' => [
                'fetchSessionExists',
                ['my-url-key'],
                Exists::class,
                '/sessions/url-key/my-url-key/exists',
            ],
        ];
    }

    public function testFetchByCityAndEventNormalizesEachItem(): void
    {
        $showtime = new ShowTimeByMovie();
        $this->normalizer->expects($this->once())
            ->method('normalize')
            ->with(['id' => 'a'], ShowTimeByMovie::class)
            ->willReturn($showtime);

        $repository = $this->createRepository(SessionsRepository::class, [['id' => 'a']]);

        $this->assertSame([$showtime], $repository->fetchByCityAndEvent('event-1'));
        $this->assertRequestedEndpoint(
            '/sessions/city/' . self::CITY_ID . '/event/event-1/partnership/' . self::PARTNERSHIP
        );
    }

    public function testFetchByEventAndPartnershipNormalizesEachItem(): void
    {
        $first = new ShowTimeByMovie();
        $second = new ShowTimeByMovie();
        $response = [['id' => 'a'], ['id' => 'b']];
        $this->normalizer->expects($this->exactly(2))
            ->method('normalize')
            ->withConsecutive(
                [['id' => 'a'], ShowTimeByMovie::class],
                [['id' => 'b'], ShowTimeByMovie::class]
            )
            ->willReturnOnConsecutiveCalls($first, $second);

        $repository = $this->createRepository(SessionsRepository::class, $response);

        $this->assertSame([$first, $second], $repository->fetchByEventAndPartnership('event-1'));
        $this->assertRequestedEndpoint('/sessions/event/event-1/partnership/' . self::PARTNERSHIP);
    }

    /**
     * @dataProvider emptyResponseMethodsProvider
     */
    public function testEmptyResponse(string $method, array $arguments, mixed $expected): void
    {
        $this->normalizer->expects($this->never())->method('normalize');

        $repository = $this->createRepository(SessionsRepository::class, []);

        $this->assertSame($expected, $repository->{$method}(...$arguments));
    }

    /**
     * @return array<string, array{string, array, mixed}>
     */
    public static function emptyResponseMethodsProvider(): array
    {
        return [
            'one' => ['fetchOne', ['session-1'], null],
            'by city and theater' => ['fetchByCityAndTheater', [], null],
            'by city and event' => ['fetchByCityAndEvent', ['event-1'], []],
            'by event and partnership' => ['fetchByEventAndPartnership', ['event-1'], []],
            'dated by event' => ['fetchDatedByEvent', ['event-1'], null],
            'session exists' => ['fetchSessionExists', ['my-url-key'], null],
        ];
    }
}
