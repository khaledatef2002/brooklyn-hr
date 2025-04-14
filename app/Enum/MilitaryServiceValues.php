<?php

namespace App\Enum;

enum MilitaryServiceValues: string
{
    case COMPLETED = 'completed';
    case permenant = 'permenant';
    case postponed = 'postponed';

    public static function getValues(): array
    {
        return array_column(self::cases(), 'value');
    }
}
