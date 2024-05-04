<?php

namespace App\Models;

use App\Enums\CryptoCurrencyUser\AnalyzeAlarmEnum;
use App\Enums\CryptoCurrencyUser\AnalyzeMethodEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CryptoCurrencyUser extends Model
{
    use HasFactory;

    protected $table = 'crypto_currency_user';

    protected $fillable = [
        'user_id',
        'crypto_currency_id',
        'analyze_method',
        'analyze_alarm',
        'analyze_alarm_percent',
        'analyze_alarm_activated_date',
        'is_analyze_alarm_activated',
        'is_active',

    ];

    protected function casts(): array
    {
        return [
            'analyze_alarm' => AnalyzeAlarmEnum::class,
            'analyze_method' => AnalyzeMethodEnum::class,
        ];
    }

    public function cryptoCurrency(): BelongsTo
    {
        return $this->belongsTo(CryptoCurrency::class, 'crypto_currency_id', 'id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
