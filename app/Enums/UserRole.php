<?php
declare(strict_types = 1);

namespace App\Enums;

class UserRole {

    const ADMIN = 'admin';
    const USER = 'user';

    const ROLES = [
        self::ADMIN,
        self::USER
    ];
}