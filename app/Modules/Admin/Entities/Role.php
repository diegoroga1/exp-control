<?php

namespace Modules\Admin\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Role extends \Spatie\Permission\Models\Role
{
    use HasFactory;


    protected static function newFactory()
    {
        return \Modules\Admin\Database\factories\RoleFactory::new();
    }
}
