<?php

declare(strict_types=1);

namespace Yeremi\Ingresso\Tests\Unit\Application\UseCases;

use PHPUnit\Framework\TestCase;
use Yeremi\Ingresso\Application\UseCases\FetchSessionsUseCase;
use Yeremi\Ingresso\Domain\Repositories\SessionsRepositoryInterface;
use Yeremi\Ingresso\Domain\ValueObject\Exists;
use Yeremi\Ingresso\Domain\ValueObject\GenericSession;
use Yeremi\Ingresso\Domain\ValueObject\ShowTimeByMovie;
use Yeremi\Ingresso\Domain\ValueObject\ShowtimeByTheater;
use Yeremi\Ingresso\Domain\ValueObject\ShowtimeDates;

/**
 * @covers \Yeremi\Ingresso\Application\UseCases\FetchSessionsUseCase
 */
class FetchSessionsUseCaseTest extends TestCase
{
    public function testGetOneReturnsRepositorySession(): void
    {
        $session = new GenericSession();
        $repository = $this->createMock(SessionsRepositoryInterface::class);
        $repository->expects($this->once())
            ->method('fetchOne')
            ->with('session-1')
            ->willReturn($session);

        $useCase = new FetchSessionsUseCase($repository);

        $this->assertSame($session, $useCase->getOne('session-1'));
    }

    public function testGetOneReturnsEmptySessionWhenRepositoryReturnsNull(): void
    {
        $repository = $this->createMock(SessionsRepositoryInterface::class);
        $repository->method('fetchOne')->willReturn(null);

        $useCase = new FetchSessionsUseCase($repository);

        $this->assertEquals(new GenericSession(), $useCase->getOne('missing'));
    }

    public function testGetByCityAndTheaterReturnsRepositoryResult(): void
    {
        $showtime = new ShowtimeByTheater();
        $repository = $this->createMock(SessionsRepositoryInterface::class);
        $repository->method('fetchByCityAndTheater')->willReturn($showtime);

        $useCase = new FetchSessionsUseCase($repository);

        $this->assertSame($showtime, $useCase->getByCityAndTheater());
    }

    public function testGetByCityAndTheaterReturnsEmptyObjectWhenRepositoryReturnsNull(): void
    {
        $repository = $this->createMock(SessionsRepositoryInterface::class);
        $repository->method('fetchByCityAndTheater')->willReturn(null);

        $useCase = new FetchSessionsUseCase($repository);

        $this->assertEquals(new ShowtimeByTheater(), $useCase->getByCityAndTheater());
    }

    public function testGetByCityAndEventReturnsRepositoryResult(): void
    {
        $showtimes = [new ShowTimeByMovie()];
        $repository = $this->createMock(SessionsRepositoryInterface::class);
        $repository->expects($this->once())
            ->method('fetchByCityAndEvent')
            ->with('event-1')
            ->willReturn($showtimes);

        $useCase = new FetchSessionsUseCase($repository);

        $this->assertSame($showtimes, $useCase->getByCityAndEvent('event-1'));
    }

    public function testGetByCityAndEventReturnsEmptyArrayWhenRepositoryReturnsNull(): void
    {
        $repository = $this->createMock(SessionsRepositoryInterface::class);
        $repository->method('fetchByCityAndEvent')->willReturn(null);

        $useCase = new FetchSessionsUseCase($repository);

        $this->assertSame([], $useCase->getByCityAndEvent('event-1'));
    }

    public function testGetByEventAndPartnershipReturnsShowtimes(): void
    {
        $showtimes = [new ShowTimeByMovie(), new ShowTimeByMovie()];
        $repository = $this->createMock(SessionsRepositoryInterface::class);
        $repository->expects($this->once())
            ->method('fetchByEventAndPartnership')
            ->with('event-1')
            ->willReturn($showtimes);

        $useCase = new FetchSessionsUseCase($repository);

        $this->assertSame($showtimes, $useCase->getByEventAndPartnership('event-1'));
    }

    public function testGetByEventAndPartnershipReturnsEmptyArrayWhenRepositoryReturnsNull(): void
    {
        $repository = $this->createMock(SessionsRepositoryInterface::class);
        $repository->method('fetchByEventAndPartnership')->willReturn(null);

        $useCase = new FetchSessionsUseCase($repository);

        $this->assertSame([], $useCase->getByEventAndPartnership('event-1'));
    }

    public function testGetByEventAndPartnershipRejectsUnexpectedItems(): void
    {
        $repository = $this->createMock(SessionsRepositoryInterface::class);
        $repository->method('fetchByEventAndPartnership')
            ->willReturn([new ShowTimeByMovie(), new GenericSession()]);

        $useCase = new FetchSessionsUseCase($repository);

        $this->assertSame([], $useCase->getByEventAndPartnership('event-1'));
    }

    public function testGetDatedByEventReturnsRepositoryResult(): void
    {
        $dates = new ShowtimeDates();
        $repository = $this->createMock(SessionsRepositoryInterface::class);
        $repository->expects($this->once())
            ->method('fetchDatedByEvent')
            ->with('event-1')
            ->willReturn($dates);

        $useCase = new FetchSessionsUseCase($repository);

        $this->assertSame($dates, $useCase->getDatedByEvent('event-1'));
    }

    public function testGetDatedByEventReturnsEmptyObjectWhenRepositoryReturnsNull(): void
    {
        $repository = $this->createMock(SessionsRepositoryInterface::class);
        $repository->method('fetchDatedByEvent')->willReturn(null);

        $useCase = new FetchSessionsUseCase($repository);

        $this->assertEquals(new ShowtimeDates(), $useCase->getDatedByEvent('event-1'));
    }

    /**
     * @dataProvider sessionExistsProvider
     */
    public function testGetSessionExists(?Exists $exists, bool $expected): void
    {
        $repository = $this->createMock(SessionsRepositoryInterface::class);
        $repository->expects($this->once())
            ->method('fetchSessionExists')
            ->with('url-key')
            ->willReturn($exists);

        $useCase = new FetchSessionsUseCase($repository);

        $this->assertSame($expected, $useCase->getSessionExists('url-key'));
    }

    /**
     * @return array<string, array{?Exists, bool}>
     */
    public static function sessionExistsProvider(): array
    {
        return [
            'no response' => [null, false],
            'not found' => [new Exists(status: 404), false],
            'found' => [new Exists(status: 200), true],
        ];
    }
}
