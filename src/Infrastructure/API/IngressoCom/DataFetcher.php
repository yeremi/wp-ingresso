<?php

declare(strict_types=1);

namespace Yeremi\Ingresso\Infrastructure\API\IngressoCom;

use Yeremi\Ingresso\Exception\ExceptionHandler;

class DataFetcher
{
    private const API_BASE_URL = 'https://api-content.ingresso.com/v0';

    public function __construct(
        private readonly ExceptionHandler $exceptionHandler
    ) {
    }

    public function fetchData(string $token, string $queryParams): array
    {
        $args = [
            'headers' => [
                'sslverify' => true,
                'Content-Type' => 'application/json',
            ],
        ];

        if ($token !== '' && $token !== '0') {
            $args['headers']['Authorization'] = 'Bearer ' . $token;
        }

        $response = wp_safe_remote_get(self::API_BASE_URL . $queryParams, $args);

        if (is_wp_error($response)) {
            $this->exceptionHandler->handle(
                sprintf(
                    'Failed to fetch external data: %s ',
                    esc_html($response->get_error_message())
                )
            );
            return [];
        }

        $statusCode = wp_remote_retrieve_response_code($response);
        if ($statusCode === 404) {
            return [];
        }

        $data = (array) json_decode(wp_remote_retrieve_body($response), true);

        if (!$data) {
            $this->exceptionHandler->handle('No data received from the external API.');
            return [];
        }

        return $data;
    }
}
