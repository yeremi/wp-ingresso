<?php

declare(strict_types=1);

namespace Yeremi\Ingresso\Domain\ValueObject;

use Yeremi\SchemaMapper\Attributes\ApiSchema;

// phpcs:ignore Inpsyde.CodeQuality.PropertyPerClassLimit.TooManyProperties
class GenericSession
{
    public function __construct(
        #[ApiSchema('id')]
        private readonly string $id = '',
        #[ApiSchema('boxOfficeId')]
        private readonly string $boxOfficeId = '',
        #[ApiSchema('eventBoxOfficeId')]
        private readonly string $eventBoxOfficeId = '',
        #[ApiSchema('price')]
        private readonly float $price = 0.0,
        #[ApiSchema('room')]
        private readonly string $room = '',
        #[ApiSchema('type')]
        private readonly array $type = [],
        #[ApiSchema('types', GenericSessionSessionType::class, isArray: true)]
        private readonly array $types = [],
        #[ApiSchema('date', DummyDate::class)]
        private readonly ?DummyDate $date = null,
        #[ApiSchema('realDate', DummyDate::class)]
        private readonly ?DummyDate $realDate = null,
        #[ApiSchema('time')]
        private readonly string $time = '',
        #[ApiSchema('defaultSector')]
        private readonly string $defaultSector = '',
        #[ApiSchema('midnightMessage')]
        private readonly string $midnightMessage = '',
        #[ApiSchema('siteURL')]
        private readonly string $siteUrl = '',
        #[ApiSchema('nationalSiteURL')]
        private readonly string $nationalSiteUrl = '',
        #[ApiSchema('appCheckoutUrl')]
        private readonly string $appCheckoutUrl = '',
        #[ApiSchema('hasSeatSelection')]
        private readonly bool $hasSeatSelection = false,
        #[ApiSchema('driveIn')]
        private readonly bool $driveIn = false,
        #[ApiSchema('streaming')]
        private readonly bool $streaming = false,
        #[ApiSchema('useNewCheckoutUrl')]
        private readonly bool $useNewCheckoutUrl = false,
        #[ApiSchema('isNewCheckout')]
        private readonly bool $isNewCheckout = false,
        #[ApiSchema('maxTicketsPerCar')]
        private readonly int $maxTicketsPerCar = 0,
        #[ApiSchema('enabled')]
        private readonly bool $enabled = false,
        #[ApiSchema('blockMessage')]
        private readonly string $blockMessage = '',
        #[ApiSchema('newCheckoutAppIos')]
        private readonly bool $newCheckoutAppIos = false,
        #[ApiSchema('newCheckoutAppAndroid')]
        private readonly bool $newCheckoutAppAndroid = false,
        #[ApiSchema('newCheckoutSuitMobileIos')]
        private readonly bool $newCheckoutSuitMobileIos = false,
        #[ApiSchema('newCheckoutSuitMobileAndroid')]
        private readonly bool $newCheckoutSuitMobileAndroid = false,
        // End of GenericSession
        // Additional properties start
        #[ApiSchema('sessionTypeCode')]
        private readonly string $sessionTypeCode = '',
        #[ApiSchema('theater')]
        private readonly string $theater = '',
        #[ApiSchema('event')]
        private readonly string $event = '',
    ) {
    }

    public function getId(): string
    {

        return $this->id;
    }

    public function getBoxOfficeId(): string
    {

        return $this->boxOfficeId;
    }

    public function getEventBoxOfficeId(): string
    {

        return $this->eventBoxOfficeId;
    }

    public function getPrice(): float
    {

        return $this->price;
    }

    public function getRoom(): string
    {

        return $this->room;
    }

    public function getType(): array
    {

        return $this->type;
    }

    public function getTypes(): array
    {

        return $this->types;
    }

    public function getDate(): ?DummyDate
    {

        return $this->date;
    }

    public function getRealDate(): ?DummyDate
    {

        return $this->realDate;
    }

    public function getTime(): string
    {

        return $this->time;
    }

    public function getDefaultSector(): string
    {

        return $this->defaultSector;
    }

    public function getMidnightMessage(): string
    {

        return $this->midnightMessage;
    }

    public function getSiteUrl(): string
    {

        return $this->siteUrl;
    }

    public function getNationalSiteUrl(): string
    {

        return $this->nationalSiteUrl;
    }

    public function getAppCheckoutUrl(): string
    {

        return $this->appCheckoutUrl;
    }

    public function isHasSeatSelection(): bool
    {

        return $this->hasSeatSelection;
    }

    public function isDriveIn(): bool
    {

        return $this->driveIn;
    }

    public function isStreaming(): bool
    {

        return $this->streaming;
    }

    public function isUseNewCheckoutUrl(): bool
    {

        return $this->useNewCheckoutUrl;
    }

    public function isNewCheckout(): bool
    {

        return $this->isNewCheckout;
    }

    public function getMaxTicketsPerCar(): int
    {

        return $this->maxTicketsPerCar;
    }

    public function isEnabled(): bool
    {

        return $this->enabled;
    }

    public function getBlockMessage(): string
    {

        return $this->blockMessage;
    }

    public function isNewCheckoutAppIos(): bool
    {

        return $this->newCheckoutAppIos;
    }

    public function isNewCheckoutAppAndroid(): bool
    {

        return $this->newCheckoutAppAndroid;
    }

    public function isNewCheckoutSuitMobileIos(): bool
    {

        return $this->newCheckoutSuitMobileIos;
    }

    public function isNewCheckoutSuitMobileAndroid(): bool
    {

        return $this->newCheckoutSuitMobileAndroid;
    }

    public function getSessionTypeCode(): string
    {

        return $this->sessionTypeCode;
    }

    public function getTheater(): string
    {

        return $this->theater;
    }

    public function getEvent(): string
    {

        return $this->event;
    }
}
