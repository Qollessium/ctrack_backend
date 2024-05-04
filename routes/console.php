<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Schedule::command('app:create_historical_m1')->everyMinute(); // it actually fetches record from source
Schedule::command('app:create_historical_m5')->everyFiveMinutes();
Schedule::command('app:create_historical_m15')->everyFifteenMinutes();
Schedule::command('app:create_historical_m30')->everyThirtyMinutes();
Schedule::command('app:create_historical_h1')->hourly();
Schedule::command('app:create_historical_h4')->everyFourHours();

Schedule::command('app:analyze_alarm_general')->everyMinute(); // bir dakika çok fazla 30dk veya 15dk civarı olmalı normalde
