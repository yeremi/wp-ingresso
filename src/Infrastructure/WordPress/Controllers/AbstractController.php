<?php

declare(strict_types=1);

namespace Yeremi\Ingresso\Infrastructure\WordPress\Controllers;

use Yeremi\Ingresso\Infrastructure\WordPress\Routing\RewriteRule;
use Yeremi\Ingresso\Infrastructure\WordPress\Routing\RewriteRuleHandler;
use Yeremi\Ingresso\Infrastructure\WordPress\Templates\TemplateLoader;

abstract class AbstractController
{
    protected string $templateName = '';

    public function __construct(
        private readonly RewriteRuleHandler $rewriteRuleHandler,
        private readonly RewriteRule $rewriteRule,
        private readonly TemplateLoader $templateLoader,
    ) {

        $this->templateName = $this->defineTemplateName();
    }

    public function register(): void
    {
        $this->rewriteRuleHandler->registerRule($this->rewriteRule)->init();
        add_filter('template_include', $this->handleTemplate(...));
    }

    public function handleTemplate(string $template): string
    {
        if (get_query_var($this->rewriteRule->getQueryVar())) {
            $locatedTemplate = $this->templateLoader->loadTemplate($this->templateName);
            return $locatedTemplate ?: $template;
        }

        return $template;
    }

    abstract protected function defineTemplateName(): string;
}
