<?php

declare(strict_types=1);

namespace Yeremi\Ingresso\Presentation\Admin;

use Yeremi\Ingresso\Domain\Entity\SettingsEntity;

class SettingsManagerManager implements SettingsManagerInterface
{
    private string $optionKey = 'wp_ingresso_settings';

    public function getAll(): SettingsEntity
    {
        $options = (array) get_option($this->optionKey, []);
        return SettingsEntity::loadFromOptions($options);
    }

    public function save(SettingsEntity $settingsEntity): void
    {
        $options = $settingsEntity->toArray();
        update_option($this->optionKey, $options);
    }
}
