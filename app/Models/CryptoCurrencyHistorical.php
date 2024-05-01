<?php

namespace App\Models;

use App\Enums\CryptoCurrency\SourceEnum;
use App\Enums\CryptoCurrencyHistorical\IntervalEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CryptoCurrencyHistorical extends Model
{
    use HasFactory;

    protected $fillable = [
        'crypto_currency_id',
        'price',
        'interval',
        'date',
        'source',
    ];

    protected function casts(): array
    {
        return [
            'interval' => IntervalEnum::class,
            'source' => SourceEnum::class,
        ];
    }
}
