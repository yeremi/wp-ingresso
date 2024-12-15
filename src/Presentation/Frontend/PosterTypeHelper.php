<?php

declare(strict_types=1);

namespace Yeremi\Ingresso\Presentation\Frontend;

use Yeremi\Ingresso\Domain\ValueObject\ImageType;

class PosterTypeHelper
{
    public static function portrait(): ImageType
    {
        return ImageType::POSTER_PORTRAIT;
    }

    public static function horizontal(): ImageType
    {
        return ImageType::POSTER_HORIZONTAL;
    }
}
