<?php

namespace App\Repositories;

use App\Settings;

class SettingsRepository
{
    public function getAll()
    {
        foreach (Settings::all() as $setting) {
            return $setting;
        }
    }
}
