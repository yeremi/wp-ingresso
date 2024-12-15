<?php

declare(strict_types=1);

namespace Yeremi\Ingresso\Domain\ValueObject;

enum ImageType: string
{
    case POSTER_PORTRAIT = 'PosterPortrait';
    case POSTER_HORIZONTAL = 'PosterHorizontal';
}
