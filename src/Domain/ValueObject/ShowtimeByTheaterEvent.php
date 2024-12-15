<?php

declare(strict_types=1);

namespace Yeremi\Ingresso\Domain\ValueObject;

use Yeremi\SchemaMapper\Attributes\ApiSchema;

class ShowtimeByTheaterEvent
{
    public function __construct(
        #[ApiSchema('id')]
        private readonly string $id = '',
        #[ApiSchema('b2BId')]
        private readonly int $b2bId = 0,
        #[ApiSchema('type')]
        private readonly string $type = '',
        #[ApiSchema('title')]
        private readonly string $title = '',
        #[ApiSchema('originalTitle')]
        private readonly string $originalTitle = '',
        #[ApiSchema('movieIdUrl')]
        private readonly string $movieIdUrl = '',
        #[ApiSchema('inPreSale')]
        private readonly bool $inPreSale = false,
        #[ApiSchema('isReexhibition')]
        private readonly bool $isReExhibition = false,
        #[ApiSchema('duration')]
        private readonly string $duration = '',
        #[ApiSchema('contentRating')]
        private readonly string $contentRating = '',
        #[ApiSchema('distributor')]
        private readonly string $distributor = '',
        #[ApiSchema('urlKey')]
        private readonly string $urlKey = '',
        #[ApiSchema('siteURL')]
        private readonly string $siteUrl = '',
        #[ApiSchema('nationalSiteURL')]
        private readonly string $nationalSiteUrl = '',
        #[ApiSchema('ancineId')]
        private readonly string $ancineId = '',
        #[ApiSchema('images', Image::class)]
        private readonly array $images = [],
        #[ApiSchema('trailers', Trailer::class)]
        private readonly array $trailers = [],
        #[ApiSchema('genres')]
        private readonly array $genres = [],
        #[ApiSchema('ratingDescriptors')]
        private readonly array $ratingDescriptors = [],
        #[ApiSchema('accessibilityHubs', AccessibilityHub::class)]
        private readonly array $accessibilityHubs = [],
        #[ApiSchema('tags')]
        private readonly array $tags = [],
        #[ApiSchema('completeTags', GenericTag::class)]
        private readonly array $completeTags = [],
        #[ApiSchema('rooms', GenericTheaterRoom::class)]
        private readonly array $rooms = [],
        #[ApiSchema('sessionTypes', GenericTheaterSessionType::class)]
        private readonly array $sessionTypes = [],
    ) {
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getB2bId(): int
    {
        return $this->b2bId;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getOriginalTitle(): string
    {
        return $this->originalTitle;
    }

    public function getMovieIdUrl(): string
    {
        return $this->movieIdUrl;
    }

    public function isInPreSale(): bool
    {
        return $this->inPreSale;
    }

    public function isReExhibition(): bool
    {
        return $this->isReExhibition;
    }

    public function getDuration(): string
    {
        return $this->duration;
    }

    public function getContentRating(): string
    {
        return $this->contentRating;
    }

    public function getDistributor(): string
    {
        return $this->distributor;
    }

    public function getUrlKey(): string
    {
        return $this->urlKey;
    }

    public function getSiteUrl(): string
    {
        return $this->siteUrl;
    }

    public function getNationalSiteUrl(): string
    {
        return $this->nationalSiteUrl;
    }

    public function getAncineId(): string
    {
        return $this->ancineId;
    }

    public function getImages(): array
    {
        return $this->images;
    }

    public function getTrailers(): array
    {
        return $this->trailers;
    }

    public function getGenres(): array
    {
        return $this->genres;
    }

    public function getRatingDescriptors(): array
    {
        return $this->ratingDescriptors;
    }

    public function getAccessibilityHubs(): array
    {
        return $this->accessibilityHubs;
    }

    public function getTags(): array
    {
        return $this->tags;
    }

    public function getCompleteTags(): array
    {
        return $this->completeTags;
    }

    public function getRooms(): array
    {
        return $this->rooms;
    }

    public function getSessionTypes(): array
    {
        return $this->sessionTypes;
    }
}
