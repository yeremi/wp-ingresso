<?php

declare(strict_types=1);

namespace Yeremi\Ingresso\Infrastructure\WordPress\Controllers;

class EventsPageController extends AbstractController
{
    protected function defineTemplateName(): string
    {
        return 'template-ingresso-events.php';
    }
}
