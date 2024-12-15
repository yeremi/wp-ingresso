<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Yeremi\Utilities\Rector\SkipDummyDateObjectPropertyRector;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->rule(SkipDummyDateObjectPropertyRector::class);
};
