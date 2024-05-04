<?php

namespace App\Helpers\CryptoCurrency;

use App\Models\CryptoCurrency;
use App\Models\CryptoCurrencyUser;
use Carbon\Carbon;

class AnalyzeAlarm
{
    public static function analyzeAlarm() {
        $cryptos = CryptoCurrency::all();

        foreach ($cryptos as $crypto) {
            $m1change = $crypto->last_change_percent_m1;
            $m5change = $crypto->last_change_percent_m5;
            $m15change = $crypto->last_change_percent_m15;
            $m30change = $crypto->last_change_percent_m30;
            $h1change = $crypto->last_change_percent_h1;
            $h4change = $crypto->last_change_percent_h4;

            $nodes = CryptoCurrencyUser::where('crypto_currency_id', $crypto->id)->where('is_active', true)->get();

            $triggered = false;
            // burayı başka şekilde yapmam lazımdı ama üşendim
            foreach ($nodes as $node) {
                if($node->analyze_alarm->value == 'm1') {
                    if($node->analyze_alarm_percent < $m1change) {
                        $node->update([
                            'analyze_alarm_activated_date' => Carbon::now(),
                            'is_analyze_alarm_activated' => true
                        ]);

                        $triggered = true;
                    }
                }

                if($node->analyze_alarm->value== 'm5') {
                    if($node->analyze_alarm_percent < $m5change) {
                        $node->update([
                            'analyze_alarm_activated_date' => Carbon::now(),
                            'is_analyze_alarm_activated' => true
                        ]);

                        $triggered = true;
                    }
                }

                if($node->analyze_alarm->value == 'm15') {
                    if($node->analyze_alarm_percent < $m15change) {
                        $node->update([
                            'analyze_alarm_activated_date' => Carbon::now(),
                            'is_analyze_alarm_activated' => true
                        ]);

                        $triggered = true;
                    }
                }

                if($node->analyze_alarm->value == 'm30') {
                    if($node->analyze_alarm_percent < $m30change) {
                        $node->update([
                            'analyze_alarm_activated_date' => Carbon::now(),
                            'is_analyze_alarm_activated' => true
                        ]);

                        $triggered = true;
                    }
                }

                if($node->analyze_alarm->value == 'h1') {
                    if($node->analyze_alarm_percent < $h1change) {
                        $node->update([
                            'analyze_alarm_activated_date' => Carbon::now(),
                            'is_analyze_alarm_activated' => true
                        ]);

                        $triggered = true;
                    }
                }

                if($node->analyze_alarm->value == 'h4') {
                    if($node->analyze_alarm_percent < $h4change) {
                        $node->update([
                            'analyze_alarm_activated_date' => Carbon::now(),
                            'is_analyze_alarm_activated' => true
                        ]);

                        $triggered = true;
                    }
                }

                if($triggered) {
                    // mesaj atma falan varsa o eklenir buraya
                }

            }
        }
    }
}
