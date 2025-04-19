<?php

namespace App\Enum;

enum NationalityValues: string
{
    case EGYPTION = 'egyption';
    case OTHER = 'other';

    public static function getList(): array
    {
        return [self::EGYPTION->value, self::OTHER->value];
    }
}
