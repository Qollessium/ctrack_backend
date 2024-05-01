<?php

namespace App\Models;

use App\Enums\CryptoCurrency\StatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CryptoCurrency extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'symbol',
        'status',
    ];

    protected $enumCasts = [
        'status' => StatusEnum::class,
    ];
}
