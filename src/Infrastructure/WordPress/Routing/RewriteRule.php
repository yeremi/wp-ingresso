<?php

declare(strict_types=1);

namespace Yeremi\Ingresso\Infrastructure\WordPress\Routing;

class RewriteRule
{
    public function __construct(
        private readonly string $pattern = '',
        private readonly string $queryVar = '',
    ) {
    }

    public function getPattern(): string
    {
        return $this->pattern;
    }

    public function getQueryVar(): string
    {
        return $this->queryVar;
    }
}
