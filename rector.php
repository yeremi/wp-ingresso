<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Set\ValueObject\LevelSetList;
use Yeremi\Utilities\Rector\SkipDummyDateObjectPropertyRector;

return RectorConfig::configure()
    ->withPaths([
        __DIR__ . '/src',
        __DIR__ . '/tests',
    ])
    ->withSkip([
        __DIR__ . '/cache/*',
    ])
    ->withSets([LevelSetList::UP_TO_PHP_82])
    ->withRules([
        SkipDummyDateObjectPropertyRector::class,
    ])
    ->withImportNames(removeUnusedImports: true)
    ;
