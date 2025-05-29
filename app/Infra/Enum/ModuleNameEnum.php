<?php

namespace App\Infra\Enum;

use App\Models\User\User;

enum ModuleNameEnum: string
{
    case UserPtBr = 'Usuários';

    public static function getLabelPtBr(string $modelName): string
    {
        return match ($modelName) {
            User::class => self::UserPtBr->value,
            default => 'Módulo desconhecido',
        };
    }
}
