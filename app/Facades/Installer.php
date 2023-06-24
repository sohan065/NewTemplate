<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class Installer extends  Facade
{
    public static function getFacadeAccessor()
    {
        return 'Installer';
    }
}
