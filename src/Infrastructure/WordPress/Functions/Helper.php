<?php

declare(strict_types=1);

namespace Yeremi\Ingresso\Infrastructure\WordPress\Functions;

use Yeremi\Ingresso\Domain\ValueObject\Event;
use Yeremi\Ingresso\Domain\ValueObject\GenericSession;
use Yeremi\Ingresso\Domain\ValueObject\GenericSessionSessionType;
use Yeremi\Ingresso\Domain\ValueObject\ImageType;
use Yeremi\Ingresso\Presentation\Frontend\PosterTypeHelper;

use function Yeremi\Ingresso\getPluginDirUrl;

final class Helper
{
    public static function getPosterPortrait(): ImageType
    {
        return PosterTypeHelper::portrait();
    }

    public static function getPosterLandscape(): ImageType
    {
        return PosterTypeHelper::horizontal();
    }

    public static function ratingColor(float $rating): string
    {
        $className = 'transparent';
        $className = match (true) {
            $rating >= 0 && $rating < 10 => 'green',
            $rating >= 10 && $rating < 12 => 'blue',
            $rating >= 12 && $rating < 14 => 'yellow',
            $rating >= 14 && $rating < 16 => 'orange',
            $rating >= 16 && $rating < 18 => 'red',
            $rating >= 18 => 'black',
            default => $className,
        };

        return $className;
    }

    public static function getAsset(string $assetName): string
    {
        $mappingImageAssets = [
            'play-icon' => getPluginDirUrl() . '/resources/img/play-icon.svg',
        ];

        return $mappingImageAssets[$assetName] ?? '';
    }

    public static function getReadableDate(string $dateString = ''): string
    {
        if (empty($dateString)) {
            return '';
        }

        $timestamp = strtotime($dateString);
        $dateFormat = (string) get_option('date_format');
        return date_i18n($dateFormat, $timestamp);
    }

    public static function getTypesLabels(GenericSession $session): array
    {
        return array_filter($session->getTypes(), static fn (GenericSessionSessionType $type): bool => $type->getAlias() !== '2D');
    }

    public static function getYouTubeThumbnailUrl(string $url): string
    {
        $defaultThumbnail = "https://i.ytimg.com/vi/default/hqdefault.jpg";

        if (empty($url)) {
            return $defaultThumbnail;
        }

        $decodedUrl = urldecode(rawurldecode($url));
        $videoId = '';

        $pattern = "/^(?:https?:)?\/\/(?:www\.)?youtube\.com\/embed\/([^\?&\"'>]+)/";

        if (preg_match($pattern, $decodedUrl, $matches)) {
            $videoId = $matches[1] ?? '';
        }

        if (empty($videoId)) {
            return $defaultThumbnail;
        }

        return "https://i.ytimg.com/vi/{$videoId}/mqdefault.jpg";
    }

    public static function getGenres(Event $event): string
    {
        /** @var string[] $genres */
        $genres = $event->getGenres();
        return implode(', ', $genres);
    }

    public static function getRatingDescriptors(Event $event): string
    {
        /** @var string[] $descriptors */
        $descriptors = $event->getRatingDescriptors();
        return implode(', ', $descriptors);
    }
}
