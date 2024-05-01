<?php

namespace App\Enums\CryptoCurrency;

enum StatusEnum: string
{
    case ACTIVE = 'active';
    case INACTIVE = 'inactive';
    case ON_HOLD = 'on_hold';
    case OFF_HOLD = 'off_hold';
    case BANNED = 'banned';
}
