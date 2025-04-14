<?php

namespace App\Enum;

enum SocialStatus: string
{
    case SINGLE = 'single';
    case MARRIED = 'married';
    case DIVORCED = 'divorced';
    case WINDOWED = 'windowed';

    public static function getValues(): array
    {
        return array_column(self::cases(), 'value');
    }
}
