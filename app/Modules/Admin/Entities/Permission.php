<?php

namespace Modules\Admin\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Permission extends \Spatie\Permission\Models\Permission
{
    use HasFactory;

    protected $fillable=[
        'description',
        'group',
        'name',
        'guard_name'
    ];

    protected static function newFactory()
    {
        return \Modules\Admin\Database\factories\PermissionFactory::new();
    }
}
