<?php

namespace App\Enum;

enum CityValues: string
{
    case CAIRO = 'cairo';
    case GIZA = 'giza';
    case ALEX = 'alex';
    case ALGHARBIA = 'algharbia';
    case ALMONIFIA = 'almonifia';
    case KAFR_ELSHEIKJ = 'kar_elsheikh';
    case ALBEHIRA = 'albehira';
    case ALDAKHALIA = 'aldakhalia';
    
    public static function getArray(): array
    {
        return array_map(fn (self $city) => $city->value, self::cases());   
    }
}
