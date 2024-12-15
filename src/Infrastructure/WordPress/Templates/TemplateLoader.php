<?php

declare(strict_types=1);

namespace Yeremi\Ingresso\Infrastructure\WordPress\Templates;

class TemplateLoader
{
    public function __construct(
        private readonly TemplateLocator $templateLocator
    ) {
    }

    public function register(): void
    {
        add_filter('template_include', $this->loadTemplate(...), 99);
    }

    public function loadTemplate(string $template): string
    {
        $newTemplate = $this->templateLocator->locate(basename($template));
        return $newTemplate ?? $template;
    }
}
