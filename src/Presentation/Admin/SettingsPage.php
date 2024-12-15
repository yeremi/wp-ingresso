<?php

declare(strict_types=1);

namespace Yeremi\Ingresso\Presentation\Admin;

use Yeremi\Ingresso\Domain\Entity\SettingsEntity;
use Yeremi\Ingresso\Exception\InvalidArgumentException;

use function Yeremi\Ingresso\getPluginDirPath;

class SettingsPage
{
    public function __construct(
        private readonly TemplateRendererFactory $templateRendererFactory,
        private readonly SettingsManagerInterface $settingsManager,
        private readonly SettingsEntity $settingsEntity
    ) {
    }

    public function init(): void
    {
        add_action('admin_menu', $this->addAdminMenu(...));
    }

    public function addAdminMenu(): void
    {
        add_options_page(
            _x('Ingresso Settings', 'Settings page title', 'wp-ingresso'),
            _x('Ingresso', 'Menu title', 'wp-ingresso'),
            'manage_options',
            'wp_ingresso_settings',
            $this->renderSettingsPage(...)
        );
    }

    public function renderSettingsPage(): void
    {
        $requestMethod = filter_input(
            INPUT_SERVER,
            'REQUEST_METHOD',
            FILTER_SANITIZE_SPECIAL_CHARS,
        );

        $nonce = filter_input(
            INPUT_POST,
            '_wpnonce',
            FILTER_SANITIZE_SPECIAL_CHARS,
        );

        $errors = [];
        $success = false;

        if ($requestMethod === 'POST') {
            if (!is_string($nonce) || empty($nonce) || !wp_verify_nonce($nonce, 'wp_ingresso_nonce')) {
                wp_die('Security failure. Invalid nonce.');
            }

            /**
             * @var array{
             *     citytId: string,
             *     theaterId: string,
             *     partnership:string
             * } $data
             */
            $data = filter_input(INPUT_POST, 'wp-ingresso', options: FILTER_REQUIRE_ARRAY) ?? [];

            $defaults = [
                'authBaseUrl' => '',
                'cityId' => '',
                'theaterId' => '',
                'partnership' => '',
            ];

            $data = array_replace($defaults, $data);

            $cityId = filter_var($data['cityId'], FILTER_SANITIZE_SPECIAL_CHARS);
            $theaterId = filter_var($data['theaterId'], FILTER_SANITIZE_SPECIAL_CHARS);
            $partnership = filter_var($data['partnership'], FILTER_SANITIZE_SPECIAL_CHARS);

            try {
                $this->settingsEntity->setCityId($cityId);
                $this->settingsEntity->setTheaterId($theaterId);
                $this->settingsEntity->setPartnership($partnership);

                $this->settingsManager->save($this->settingsEntity);
                $success = true;
            } catch (InvalidArgumentException $exception) {
                $errors[] = $exception->getMessage();
            }
        }

        $this->templateRendererFactory->getAdminRenderer()->render(
            getPluginDirPath() . 'src/Presentation/Admin/Templates/admin-settings-template.php',
            [
                'onErrors' => $errors,
                'onSuccess' => $success,
                'settings' => $this->settingsManager->getAll(),
            ]
        );
    }
}
