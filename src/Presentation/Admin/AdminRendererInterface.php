<?php

declare(strict_types=1);

namespace Yeremi\Ingresso\Presentation\Admin;

interface AdminRendererInterface
{
    public function render(string $templatePath, array $variables = []): void;
}
