<?php

declare(strict_types=1);

namespace Yeremi\Ingresso\Presentation\Admin;

use Yeremi\Ingresso\Domain\Entity\SettingsEntity;

interface SettingsManagerInterface
{
    public function getAll(): SettingsEntity;

    public function save(SettingsEntity $settingsEntity): void;
}
