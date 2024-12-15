<?php

declare(strict_types=1);

namespace Yeremi\Ingresso\Presentation\Admin;

use Throwable;
use Yeremi\Ingresso\Exception\InvalidArgumentException;

class AdminRenderer implements AdminRendererInterface
{
    /**
     * Render a template file with optional variables.
     *
     * @param string $templatePath Path to the template file.
     * @param array  $variables    Associative array of variables to pass to the template.
     *
     * @psalm-suppress MixedArgumentTypeCoercion, PossiblyFalseArgument
     */
    public function render(string $templatePath, array $variables = []): void
    {
        if (!file_exists($templatePath)) {
            throw new InvalidArgumentException(
                sprintf(
                    /* translators: Not template found message  */
                    esc_html__('Template file not found: %s', 'wp-ingresso'),
                    esc_url($templatePath)
                )
            );
        }

        ob_start();

        try {
            $this->includeTemplate($templatePath, $variables);
        } catch (Throwable $throwable) {
            ob_end_clean();
            throw $throwable;
        }

        echo wp_kses(ob_get_clean(), $this->allowedHtml());
    }

    /**
     * Includes the template file in an isolated scope.
     * @psalm-suppress MixedAssignment, UnresolvableInclude
     */
    private function includeTemplate(string $templatePath, array $variables): void
    {
        foreach ($variables as $key => $value) {
            ${$key} = $value;
        }

        include $templatePath;
    }

    private function allowedHtml(): array
    {
        $allowedHtml = wp_kses_allowed_html('post');
        $allowedHtml['input'] = [
            'class' => [],
            'id' => [],
            'name' => [],
            'value' => [],
            'type' => [],
        ];
        $allowedHtml['form'] = [
            'method' => [],
            'action' => [],
        ];

        return $allowedHtml;
    }
}
