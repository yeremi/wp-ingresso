<?php

declare(strict_types=1);

namespace Yeremi\Ingresso\Infrastructure\API;

use Exception;
use Yeremi\Ingresso\Exception\ExceptionHandler;
use Yeremi\Ingresso\Infrastructure\API\IngressoCom\DataFetcher;

class DataHandler implements DataHandlerInterface
{
    public function __construct(
        public DataFetcher $dataFetcher,
        private readonly ExceptionHandler $exceptionHandler,
    ) {
    }

    public function request(string $endpoint): array
    {
        try {
            return $this->dataFetcher->fetchData('', $endpoint);
        } catch (Exception $exception) {
            $this->exceptionHandler->handle($exception->getMessage());
        }

        return [];
    }
}
