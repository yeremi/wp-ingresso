<?php

declare(strict_types=1);

namespace Yeremi\Ingresso\Presentation\Frontend;

use function Yeremi\Ingresso\getPluginDirUrl;
use function Yeremi\Ingresso\getPluginVersion;

class ScriptsRegistration
{
    public function __construct()
    {
        add_action("wp_enqueue_scripts", $this->loadWPIngressoScripts(...));
    }

    public function loadWPIngressoScripts(): void
    {
        $suffix = wp_get_environment_type() === 'production' ? '.min' : '';
        wp_enqueue_script(
            'wp-ingresso-scripts',
            getPluginDirUrl() . 'assets/js/wp-ingresso-scripts' . $suffix . '.js',
            [],
            getPluginVersion(),
            true
        );
    }
}
