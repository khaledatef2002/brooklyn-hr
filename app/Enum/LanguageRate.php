<?php

namespace App\Enum;

enum LanguageRate: string
{
    case EXCELLENT = 'excellent';
    case VERY_GOOD = 'very_good';
    case GOOD = 'good';
    case ACCEPTED = 'ACCEPTED';
    case POOR = 'poor';

    public static function getList(): array
    {
        return [
            self::EXCELLENT->value,
            self::VERY_GOOD->value,
            self::GOOD->value,
            self::ACCEPTED->value,
            self::POOR->value,
        ];
    }
}
