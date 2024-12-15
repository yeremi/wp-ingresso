<?php

declare(strict_types=1);

namespace Yeremi\Ingresso\Domain\Entity;

class SettingsEntity
{
    private string $authBaseUrl = '';

    private string $cityId = '';

    private string $theaterId = '';

    private string $partnership = '';

    public static function loadFromOptions(array $options): self
    {
        $instance = new self();

        /**
         * @var array{
         *     cityId: string,
         *     theaterId: string,
         *     partnership:string
         * } $options
         */
        $instance->setCityId($options['cityId'] ?? '');
        $instance->setTheaterId($options['theaterId'] ?? '');
        $instance->setPartnership($options['partnership'] ?? '');

        return $instance;
    }

    public function toArray(): array
    {
        return [
            'cityId' => $this->cityId,
            'theaterId' => $this->theaterId,
            'partnership' => $this->partnership,
        ];
    }

    public function getAuthBaseUrl(): string
    {
        return $this->authBaseUrl;
    }

    public function setAuthBaseUrl(string $authBaseUrl): void
    {
        $this->authBaseUrl = $authBaseUrl;
    }

    public function getCityId(): string
    {
        return $this->cityId;
    }

    public function setCityId(string $cityId): void
    {
        $this->cityId = $cityId;
    }

    public function getTheaterId(): string
    {
        return $this->theaterId;
    }

    public function setTheaterId(string $theaterId): void
    {
        $this->theaterId = $theaterId;
    }

    public function getPartnership(): string
    {
        return $this->partnership;
    }

    public function setPartnership(string $partnership): void
    {
        $this->partnership = $partnership;
    }
}
