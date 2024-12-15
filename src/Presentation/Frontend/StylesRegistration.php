<?php

declare(strict_types=1);

namespace Yeremi\Ingresso\Presentation\Frontend;

use function Yeremi\Ingresso\getPluginDirUrl;
use function Yeremi\Ingresso\getPluginVersion;

class StylesRegistration
{
    public function __construct()
    {
        add_action('wp_enqueue_scripts', $this->loadWPIngressoStyles(...));
    }

    public function loadWPIngressoStyles(): void
    {
        $suffix = wp_get_environment_type() === 'production' ? '.min' : '';
        wp_register_style(
            'wp-ingresso-styles',
            getPluginDirUrl() . 'assets/css/wp-ingresso-styles' . $suffix . '.css',
            [],
            getPluginVersion()
        );

        wp_enqueue_style('wp-ingresso-styles');
    }
}
