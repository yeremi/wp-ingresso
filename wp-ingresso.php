<?php

/**
 * Plugin Name: WP Ingresso
 * Plugin URI:  https://github.com/yeremi/wp-ingresso
 * Description: API integration with Ingresso.com for online ticket sales.
 * Version:     0.1.0
 * Author:      Yeremi Loli <yeremiloli@yahoo.com>
 * Author URI:  https://www.linkedin.com/in/yeremiloli/
 * Text Domain: wp-ingresso
 * Domain Path: /languages
 * License:     GPL v2 or later
 */

declare(strict_types=1);

// phpcs:disable PSR1.Files.SideEffects

namespace Yeremi\Ingresso;

use Exception;
use RuntimeException;
use Yeremi\Ingresso\Infrastructure\DependencyInjection\ContainerManager;
use Yeremi\Ingresso\Infrastructure\WordPress\Controllers\EventsPageController;
use Yeremi\Ingresso\Infrastructure\WordPress\Controllers\EventPageController;
use Yeremi\Ingresso\Infrastructure\WordPress\Filters\EventsHookHandler;
use Yeremi\Ingresso\Infrastructure\WordPress\Filters\PassportPromotionHookHandler;
use Yeremi\Ingresso\Infrastructure\WordPress\Filters\SessionsHookHandler;
use Yeremi\Ingresso\Infrastructure\WordPress\Filters\TemplatesHookHandler;
use Yeremi\Ingresso\Infrastructure\WordPress\Filters\TheatersHookHandler;
use Yeremi\Ingresso\Presentation\Admin\SettingsPage;
use Yeremi\Ingresso\Presentation\Frontend\ScriptsRegistration;
use Yeremi\Ingresso\Presentation\Frontend\StylesRegistration;

if (!defined('ABSPATH')) {
    exit;
}

function getPluginDirPath(): string
{
    return plugin_dir_path(__FILE__);
}

function getPluginDirUrl(): string
{
    return plugin_dir_url(__FILE__);
}

function getPluginVersion(): string
{
    $pluginData = get_file_data(
        __FILE__,
        ['Version' => 'Version'],
        'plugin'
    );

    return $pluginData['Version'] ?? '0.1.0';
}

function init(): void
{

    if (is_readable(__DIR__ . '/vendor/autoload.php')) {
        // @noinspection PhpIncludeInspection
        include_once __DIR__ . '/vendor/autoload.php';
    }

    load_plugin_textdomain('wp-ingresso');

    try {

        /**
         * Defining the environment type
         */
        ContainerManager::setEnvironment(wp_get_environment_type());

        /**
         * Init application
         */
        $container = ContainerManager::getInstance();
        /**
         * Backend
         */
        $container->get(SettingsPage::class);

        /**
         * WordPress Hooks
         */
        $container->get(EventsHookHandler::class);
        $container->get(SessionsHookHandler::class);
        $container->get(TheatersHookHandler::class);
        $container->get(PassportPromotionHookHandler::class);
        $container->get(TemplatesHookHandler::class);
        /**
         * Frontend Assets
         */
        $container->get(StylesRegistration::class);
        $container->get(ScriptsRegistration::class);
        /**
         * Frontend Controllers
         */
        $container->get(EventPageController::class);
        $container->get(EventsPageController::class);
    } catch (Exception $validationException) {
        throw new RuntimeException(esc_html($validationException->getMessage()));
    }
}

add_action('plugins_loaded', __NAMESPACE__ . '\init', 11);
