<?php

    namespace App\Enums;

    enum UserRolesEnum :int{
        case Admin = 1;
        case Editor = 2;
        case User = 3;

        public function title(): string
        {
            return match ($this) {
                self::Admin => 'Admin',
                self::Editor => 'Editor',
                self::User => 'User',
            };
        }
    }
