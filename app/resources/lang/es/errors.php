<?php

return [
    '403' => 'Acceso denegado',
    '404' => "Página no encontrada",
    '401' => "Usuario no autenticado",
    '500' => "Error de aplicación",
    'team_role_middleware' => [
        'no_team' => "Error validando middleware. Team :team no existe",
        'unauthorized' => "Sección no autorizada"
    ],
    'db'=>[
        'integrity_error' => "Error de integridad en la base de datos",
        'owned_teams' => "No se puede borrar el usuario porque es propietario de otros equipos"
    ],
    'auth_invalid' => "Email o password incorrectos",
    'team_unauthorized' => "El usuario no pertenece al equipo :team"
];
