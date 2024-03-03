<?php

namespace App\Services;

use Nwidart\Modules\Facades\Module;

class ModuleService
{
    /**
     * Check if module exists and if is enabled
     * @param string $module
     * @return bool
     */
    public static function isEnabled(string $module): bool
    {
        return Module::has($module) && Module::find($module)->isEnabled();
    }
}
