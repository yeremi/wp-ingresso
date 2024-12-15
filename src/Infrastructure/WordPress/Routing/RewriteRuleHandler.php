<?php

declare(strict_types=1);

namespace Yeremi\Ingresso\Infrastructure\WordPress\Routing;

class RewriteRuleHandler
{
    /**
     * @var RewriteRule[]
     */
    private array $rules = [];

    public function registerRule(RewriteRule $rewriteRule): RewriteRuleHandler
    {
        $this->rules[] = $rewriteRule;
        return $this;
    }

    public function init(): void
    {
        add_action('init', $this->addRewriteRules(...));
        add_filter('query_vars', $this->addQueryVars(...));
    }

    /**
     * Add rewrite rules for all registered routes.
     */
    public function addRewriteRules(): void
    {
        foreach ($this->rules as $rule) {
            if ($rule->getPattern() === 'cinema') {
                add_rewrite_rule(
                    '^cinema/?$',
                    'index.php?cinema_page=true',
                    'top'
                );

                return;
            }

            add_rewrite_rule(
                sprintf('^%s/?$', $rule->getPattern()),
                sprintf('index.php?%s=$matches[1]', $rule->getQueryVar()),
                'top'
            );
        }
    }

    /**
     * Add query vars for all registered routes.
     */
    public function addQueryVars(array $vars): array
    {
        foreach ($this->rules as $rule) {
            $vars[] = $rule->getQueryVar();
        }

        $vars[] = 'cinema_page';

        return $vars;
    }
}
