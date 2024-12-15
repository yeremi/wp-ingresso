<?php

declare(strict_types=1);

namespace Yeremi\Ingresso\Exception;

class ExceptionHandler
{
    public function handle(string $throwable): void
    {
        echo wp_kses_post(
            '<div class="wp-ingresso-message--error"><p>' . $throwable . '</p></div>'
        );
    }
}
