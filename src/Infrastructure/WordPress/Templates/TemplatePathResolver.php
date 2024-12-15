<?php

declare(strict_types=1);

namespace Yeremi\Ingresso\Infrastructure\WordPress\Templates;

use function Yeremi\Ingresso\getPluginDirPath;

class TemplatePathResolver
{
    public function getThemeTemplatePath(string $templateName): string
    {
        return get_stylesheet_directory() . '/wp-ingresso/' . $templateName;
    }

    public function getPluginTemplatePath(string $templateName): string
    {
        return getPluginDirPath() . 'templates/' . $templateName;
    }
}
