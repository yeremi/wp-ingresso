<?php

declare(strict_types=1);

namespace Yeremi\Ingresso\Domain\ValueObject;

use Yeremi\SchemaMapper\Attributes\ApiSchema;

// phpcs:ignore Inpsyde.CodeQuality.PropertyPerClassLimit.TooManyProperties
class Event
{
    public function __construct(
        #[ApiSchema('id')]
        private readonly string $id = '',
        #[ApiSchema('title')]
        private readonly string $title = '',
        #[ApiSchema('originalTitle')]
        private readonly string $originalTitle = '',
        #[ApiSchema('type')]
        private readonly string $type = '',
        #[ApiSchema('movieIdUrl')]
        private readonly string $movieIdUrl = '',
        #[ApiSchema('ancineId')]
        private readonly string $ancineId = '',
        #[ApiSchema('countryOrigin')]
        private readonly string $countryOrigin = '',
        #[ApiSchema('priority')]
        private readonly int $priority = 0,
        #[ApiSchema('contentRating')]
        private readonly string $contentRating = '',
        #[ApiSchema('duration')]
        private readonly string $duration = '',
        #[ApiSchema('rating')]
        private readonly float $rating = 0.0,
        #[ApiSchema('synopsis')]
        private readonly string $synopsis = '',
        #[ApiSchema('cast')]
        private readonly string $cast = '',
        #[ApiSchema('director')]
        private readonly string $director = '',
        #[ApiSchema('distributor')]
        private readonly string $distributor = '',
        #[ApiSchema('inPreSale')]
        private readonly bool $inPreSale = false,
        #[ApiSchema('isReexhibition')]
        private readonly bool $isReExhibition = false,
        #[ApiSchema('urlKey')]
        private readonly string $urlKey = '',
        #[ApiSchema('isPlaying')]
        private readonly bool $isPlaying = false,
        #[ApiSchema('countIsPlaying')]
        private readonly int $countIsPlaying = 0,
        #[ApiSchema('creationDate')]
        private readonly string $creationDate = '',
        #[ApiSchema('city')]
        private readonly string $city = '',
        #[ApiSchema('siteURL')]
        private readonly string $siteUrl = '',
        #[ApiSchema('nationalSiteURL')]
        private readonly string $nationalSiteUrl = '',
        #[ApiSchema('images', Image::class, isArray: true)]
        private readonly array $images = [],
        #[ApiSchema('genres')]
        private readonly array $genres = [],
        #[ApiSchema('ratingDescriptors')]
        private readonly array $ratingDescriptors = [],
        #[ApiSchema('accessibilityHubs', AccessibilityHub::class, isArray: true)]
        private readonly array $accessibilityHubs = [],
        #[ApiSchema('completeTags', GenericTag::class, isArray: true)]
        private readonly array $completeTags = [],
        #[ApiSchema('tags')]
        private readonly array $tags = [],
        #[ApiSchema('trailers', Trailer::class, isArray: true)]
        private readonly array $trailers = [],
        #[ApiSchema('partnershipType')]
        private readonly string $partnershipType = '',
        #[ApiSchema('b2BEventId')]
        private readonly int $b2bEventId = 0,
        #[ApiSchema('cities', City::class, isArray: true)]
        private readonly array $cities = [],
        #[ApiSchema('premiereDate', DummyDate::class)]
        private readonly ?DummyDate $premierDate = null,
    ) {
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getOriginalTitle(): string
    {
        return $this->originalTitle;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getMovieIdUrl(): string
    {
        return $this->movieIdUrl;
    }

    public function getAncineId(): string
    {
        return $this->ancineId;
    }

    public function getCountryOrigin(): string
    {
        return $this->countryOrigin;
    }

    public function getPriority(): ?int
    {
        return $this->priority;
    }

    public function getContentRating(): string
    {
        return $this->contentRating;
    }

    public function getDuration(): string
    {
        return $this->duration;
    }

    public function getRating(): float
    {
        return $this->rating;
    }

    public function getSynopsis(): string
    {
        return $this->synopsis;
    }

    public function getCast(): string
    {
        return $this->cast;
    }

    public function getDirector(): string
    {
        return $this->director;
    }

    public function getDistributor(): string
    {
        return $this->distributor;
    }

    public function isInPreSale(): bool
    {
        return $this->inPreSale;
    }

    public function isReExhibition(): bool
    {
        return $this->isReExhibition;
    }

    public function getUrlKey(): string
    {
        return $this->urlKey;
    }

    public function isPlaying(): bool
    {
        return $this->isPlaying;
    }

    public function getCountIsPlaying(): ?int
    {
        return $this->countIsPlaying;
    }

    public function getCreationDate(): string
    {
        return $this->creationDate;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function getSiteUrl(): string
    {
        return $this->siteUrl;
    }

    public function getNationalSiteUrl(): string
    {
        return $this->nationalSiteUrl;
    }

    public function getImages(): array
    {
        return $this->images;
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

    public function getCompleteTags(): array
    {
        return $this->completeTags;
    }

    public function getTags(): array
    {
        return $this->tags;
    }

    public function getTrailers(): array
    {
        return $this->trailers;
    }

    public function getPartnershipType(): string
    {
        return $this->partnershipType;
    }

    public function getB2bEventId(): int
    {
        return $this->b2bEventId;
    }

    public function getCities(): array
    {
        return $this->cities;
    }

    public function getPremierDate(): ?DummyDate
    {
        return $this->premierDate ?? null;
    }
}
