<?php

namespace App\ValueObjects\UserRole;

class UserRole
{
    const ADMINISTRATOR = 9;
    const MAINTENANCE   = 5;
    const NORMAL        = 0;

    const ROLE_ONLY_ADMINISTRATOR = 'role_administrator_only';
    const ROLE_ALL_USER = 'role_all_user';

    /**
     *（管理者のみ）認可パラメータ
     *
     * @return string
     */
    static public function canOnlyAdministrators()
    {
        return "can:".self::ROLE_ONLY_ADMINISTRATOR;
    }

    /**
     *（管理者のみ）全ユーザ
     *
     * @return string
     */
    static public function canAllUsers()
    {
        return "can:".self::ROLE_ALL_USER;
    }
}
