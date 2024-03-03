<?php

return [
    'name' => 'Admin',
    'permissions' => [
        'admin.granted' => 'Acceder al módulo',

        'admin.dashboard.nav' => 'Acceder al menú de la sección',
        'admin.dashboard.list' => 'Ver la sección de dashboard',

        'admin.perms.nav' => 'Acceder al menú de la sección',
        'admin.perms.list' => 'Ver todos los elementos',
        'admin.perms.show' => 'Ver un elemento',
        'admin.perms.create' => 'Crear un elemento',
        'admin.perms.update' => 'Actualizar un elemento',
        'admin.perms.delete' => 'Eliminar un elemento',

        'admin.roles.nav' => 'Acceder al menú de la sección',
        'admin.roles.list' => 'Ver todos los elementos',
        'admin.roles.show' => 'Ver un elemento',
        'admin.roles.create' => 'Crear un elemento',
        'admin.roles.update' => 'Actualizar un elemento',
        'admin.roles.delete' => 'Eliminar un elemento',

        'admin.users.nav' => 'Acceder al menú de la sección',
        'admin.users.list' => 'Ver todos los elementos',
        'admin.users.show' => 'Ver un elemento',
        'admin.users.create' => 'Crear un elemento',
        'admin.users.update' => 'Actualizar un elemento',
        'admin.users.delete' => 'Eliminar un elemento',
    ],
    'roles' => [
        'admin' => 'Administrador con acceso ilimitado',
        'manager' => 'Responsable con acceso limitado por cliente',
        'user' => 'Operario con acceso limitado por cliente',
    ],
    'rolePermissions' => [
        'manager' => [
            'admin.granted',

            'admin.dashboard.nav',
            'admin.dashboard.list',

            'admin.roles.list',

            'admin.users.nav',
            'admin.users.list',
            'admin.users.show',
            'admin.users.create',
            'admin.users.update',
            'admin.users.delete',
        ],
        'user' => [
            'admin.dashboard.nav',
            'admin.dashboard.list',
        ],
    ],
];
