<?php

namespace App\Composers;

use App\Repositories\SettingsRepository;

class SettingComposer
{
    protected $settings;

    public function __construct(SettingsRepository $settings)
    {
        $this->settings = $settings;
    }

    public function compose($view)
    {
        $view->with('setting', $this->settings->getAll());
    }
}
