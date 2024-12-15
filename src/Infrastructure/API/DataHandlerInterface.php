<?php

declare(strict_types=1);

namespace Yeremi\Ingresso\Infrastructure\API;

interface DataHandlerInterface
{
    public function request(string $endpoint): array;
}
