<?php

namespace App\Models;

use App\Enums\CryptoCurrency\SourceEnum;
use App\Enums\CryptoCurrency\StatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
            ->withPivot('analyze_method')
            ->withTimestamps();
    }
}
