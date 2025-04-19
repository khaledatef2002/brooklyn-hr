<?php

namespace App\Enum;

enum StartingPeriodOptions: string
{
    case WITHIN_TWO_DAYS = 'within_two_days';
    case WITHIN_WEEK = 'within_week';
    case WITHIN_MONTH = 'within_month';

    public static function getValues(): array
    {
        return array_column(self::cases(), 'value');
    }
}
