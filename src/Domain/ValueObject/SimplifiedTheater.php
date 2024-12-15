<?php

declare(strict_types=1);

namespace Yeremi\Ingresso\Domain\ValueObject;

use Yeremi\SchemaMapper\Attributes\ApiSchema;

class SimplifiedTheater
{
    public function __construct(
        #[ApiSchema('id')]
        private readonly string $id = '',
        #[ApiSchema('boxOfficeId')]
        private readonly string $boxOfficeId = '',
        #[ApiSchema('name')]
        private readonly string $name = '',
        #[ApiSchema('address')]
        private readonly string $address = '',
        #[ApiSchema('addressComplement')]
        private readonly string $addressComplement = '',
        #[ApiSchema('number')]
        private readonly string $number = '',
        #[ApiSchema('urlKey')]
        private readonly string $urlKey = '',
        #[ApiSchema('neighborhood')]
        private readonly string $neighborhood = '',
        #[ApiSchema('properties', TheaterProperties::class)]
        private readonly ?TheaterProperties $theaterProperties = null,
        #[ApiSchema('functionalities', TheaterFunctionality::class)]
        private readonly ?TheaterFunctionality $theaterFunctionality = null,
        #[ApiSchema('deliveryType')]
        private readonly array $deliveryType = [],
        #[ApiSchema('siteURL')]
        private readonly string $siteUrl = '',
        #[ApiSchema('nationalSiteURL')]
        private readonly string $nationalSiteUrl = '',
        #[ApiSchema('enabled')]
        private readonly bool $enabled = false,
        #[ApiSchema('blockMessage')]
        private readonly string $blockMessage = '',
        #[ApiSchema('rooms', GenericTheaterRoom::class, isArray: true)]
        private readonly array $rooms = [],
        #[ApiSchema('sessionTypes', GenericTheaterSession::class, isArray: true)]
        private readonly array $genericTheaterSession = [],
        #[ApiSchema('geolocation', Geolocation::class)]
        private readonly ?Geolocation $geolocation = null,
        #[ApiSchema('operationPolices', OperationPolicy::class, isArray: true)]
        private readonly array $operationPolicy = [],
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

    public function getName(): string
    {
        return $this->name;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function getAddressComplement(): string
    {
        return $this->addressComplement;
    }

    public function getNumber(): string
    {
        return $this->number;
    }

    public function getUrlKey(): string
    {
        return $this->urlKey;
    }

    public function getNeighborhood(): string
    {
        return $this->neighborhood;
    }

    public function getProperties(): ?TheaterProperties
    {
        return $this->theaterProperties;
    }

    public function getFunctionalities(): ?TheaterFunctionality
    {
        return $this->theaterFunctionality;
    }

    public function getDeliveryType(): array
    {
        return $this->deliveryType;
    }

    public function getSiteUrl(): string
    {
        return $this->siteUrl;
    }

    public function getNationalSiteUrl(): string
    {
        return $this->nationalSiteUrl;
    }

    public function isEnabled(): bool
    {
        return $this->enabled;
    }

    public function getBlockMessage(): string
    {
        return $this->blockMessage;
    }

    public function getRooms(): array
    {
        return $this->rooms;
    }

    public function getSessionTypes(): array
    {
        return $this->genericTheaterSession;
    }

    public function getGeolocation(): ?Geolocation
    {
        return $this->geolocation;
    }

    public function getOperationPolices(): array
    {
        return $this->operationPolicy;
    }
}
