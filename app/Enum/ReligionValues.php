<?php

namespace App\Enum;

enum ReligionValues: string
{
    case islam = "islam";
    case chris = "chris";
    case juese = "juese";

    public static function getValues(): array
    {
        return array_column(self::cases(), 'value');
    }
}
