<?php

namespace App\Models;

use App\Enums\CryptoCurrency\SourceEnum;
use App\Enums\CryptoCurrency\StatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CryptoCurrency extends Model
{
    use HasFactory;

    protected $fillable = [
        'coincap_id',
        'name',
        'description',
        'symbol',
        'status',
        'source',
        'last_record_m1',
        'last_record_m5',
        'last_record_m15',
        'last_record_m30',
        'last_record_h1',
        'last_record_h4',
        'last_change_percent_m1',
        'last_change_percent_m5',
        'last_change_percent_m15',
        'last_change_percent_m30',
        'last_change_percent_h1',
        'last_change_percent_h4',
    ];

    protected function casts(): array
    {
        return [
            'status' => StatusEnum::class,
            'source' => SourceEnum::class,
        ];
    }

    public function users()
    {
        return $this->belongsToMany(User::class)
            ->withPivot(
                'analyze_method',
                'analyze_alarm',
                'analyze_alarm_percent',
                'analyze_alarm_activated_date',
                'is_analyze_alarm_activated',
                'is_active'
            )
            ->withTimestamps();
    }

    public function lastRecordM1(): BelongsTo
    {
        return $this->belongsTo(CryptoCurrencyHistorical::class, 'last_record_m1');
    }

    public function lastRecordM5(): BelongsTo
    {
        return $this->belongsTo(CryptoCurrencyHistorical::class, 'last_record_m5');
    }

    public function lastRecordM15(): BelongsTo
    {
        return $this->belongsTo(CryptoCurrencyHistorical::class, 'last_record_m15');
    }

    public function lastRecordM30(): BelongsTo
    {
        return $this->belongsTo(CryptoCurrencyHistorical::class, 'last_record_m30');
    }

    public function lastRecordH1(): BelongsTo
    {
        return $this->belongsTo(CryptoCurrencyHistorical::class, 'last_record_h1');
    }

    public function lastRecordH4(): BelongsTo
    {
        return $this->belongsTo(CryptoCurrencyHistorical::class, 'last_record_h4');
    }
}
