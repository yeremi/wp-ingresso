<?php

declare(strict_types=1);

namespace Yeremi\Ingresso\Presentation\Admin;

class TemplateRendererFactory
{
    public function __construct(
        private readonly AdminRendererInterface $adminRenderer,
    ) {
    }

    public function getAdminRenderer(): AdminRendererInterface
    {
        return $this->adminRenderer;
    }
}
