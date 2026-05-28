<?php

namespace App\Enum;

enum Roles: string
{
    case ROLE_USER = 'ROLE_ETUDIANT';
    case ROLE_ADMIN = 'ROLE_ADMIN';
    case ROLE_RESPONSABLE = 'ROLE_RESPONSABLE';
    case ROLE_PRESIDENT = 'ROLE_PRESIDENT';
}

