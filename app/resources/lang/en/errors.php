<?php

return [
    '403' => 'Forbidden',
    '404' => "Page not found",
    '401' => "User not authenticated",
    '500' => "Application Error",
    'team_role_middleware' => [
        'no_team' => "Middleware error. Team :team not found",
        'unauthorized' => "Section not authorized"
    ],
    'db'=>[
        'integrity_error' => "Error integrity in database",
        'owned_teams' => "This user isn't delete because is teams owner"
    ],
    'auth_invalid' => "Email or password failure",
    'team_unauthorized' => "User isn't :team member"
];
