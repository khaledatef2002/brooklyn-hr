<?php

namespace App\Enum;

enum ReligionValues: string
{
    case islam = "islam";
    case chris = "chris";

    public static function getValues(): array
    {
        return array_column(self::cases(), 'value');
    }
}
