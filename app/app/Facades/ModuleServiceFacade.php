<?php

namespace App\Facades;

use App\Services\ModuleService;
use Illuminate\Support\Facades\Facade;

class ModuleServiceFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return ModuleService::class;
    }
}
