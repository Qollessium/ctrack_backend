<?php

namespace App\Enums\CryptoCurrencyUser;

enum AnalyzeAlarmEnum: string
{
    case M1 = 'm1';
    case M5 = 'm5';
    case M15 = 'm15';
    case M30 = 'm30';
    case H1 = 'h1';
    case H4 = 'h4';
    case UNKNOWN = 'unknown';
}

