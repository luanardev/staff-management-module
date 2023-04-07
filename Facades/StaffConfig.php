<?php

namespace Lumis\StaffManagement\Facades;

use Illuminate\Support\Facades\Facade;

class StaffConfig extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'staff-config';
    }

}

