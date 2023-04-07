<?php

namespace Lumis\StaffManagement\Http\Livewire\Settings;

use Luanardev\LivewireUI\LivewireUI;
use StaffConfig;

class GeneralConfig extends LivewireUI
{
    public $settings = array();

    public function __construct()
    {
        $this->settings = StaffConfig::getSettings();
    }

    public function render()
    {
        return view("staffmanagement::livewire.settings.general.index");
    }

    public function save()
    {
        StaffConfig::saveAll($this->settings);
        $this->emitRefresh()->toastr('Settings saved');
    }


}
