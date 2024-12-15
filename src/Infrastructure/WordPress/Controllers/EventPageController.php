<?php

declare(strict_types=1);

namespace Yeremi\Ingresso\Infrastructure\WordPress\Controllers;

class EventPageController extends AbstractController
{
    protected function defineTemplateName(): string
    {
        return 'template-ingresso-event.php';
    }
}
