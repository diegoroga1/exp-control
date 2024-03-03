<?php

return [
    '403' => 'Accés denegat!',
    '404' => "Pàgina no trobada",
    '401' => "Usuari no autenticat",
    '500' => "Error general d'aplicació",
    'team_role_middleware' => [
        'no_team' => "Error validant middleware. Team :team no existeix",
        'unauthorized' => "Secció no autoritzada"
    ],
    'db' => [
        'integrity_error' => "Error d'integritat a la base de dades",
        'owned_teams' => "No es pot esborrar l'usuari perquè és propietari d'altres equips"
    ],
    'auth_invalid' => "Email o password incorrectes",
    'team_unauthorized' => "L'usuari no pertany a l'equip :team"

];
