<?php

namespace App\Http\Requests\API\User;

use App\Enums\CryptoCurrency\User\AnalyzeMethodEnum;
use App\Enums\CryptoCurrencyUser\AnalyzeAlarmEnum;
use App\Models\CryptoCurrency;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class AttachCryptoCurrencyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        return [
            'crypto_currency_id' => [
                'required',
                'exists:crypto_currencies,id',
            ],
            'analyze_method' => [
                'required',
                new Enum(AnalyzeMethodEnum::class),
            ],
            'analyze_alarm' => [
                'required',
                new Enum(AnalyzeAlarmEnum::class),
            ],
            'analyze_alarm_percent' => [
                'required',
                'numeric'
            ],
            'is_active' => [
                'required',
                'boolean'
            ],
        ];
    }
}
