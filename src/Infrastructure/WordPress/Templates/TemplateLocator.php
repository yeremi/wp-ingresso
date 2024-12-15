<?php

declare(strict_types=1);

namespace Yeremi\Ingresso\Infrastructure\WordPress\Templates;

class TemplateLocator
{
    public function __construct(
        private readonly TemplatePathResolver $templatePathResolver
    ) {
    }

    public function locate(string $templateName): ?string
    {
        $themePath = $this->templatePathResolver->getThemeTemplatePath($templateName);

        if (file_exists($themePath)) {
            return $themePath;
        }

        $pluginPath = $this->templatePathResolver->getPluginTemplatePath($templateName);

        if (file_exists($pluginPath)) {
            return $pluginPath;
        }

        return null;
    }
}
