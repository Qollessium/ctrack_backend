<?php

namespace App\Console\Commands;

use App\Helpers\CryptoCurrency\AnalyzeAlarm;
use Illuminate\Console\Command;

class analyze_alarm_general extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:analyze_alarm_general';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $helper = new AnalyzeAlarm();
        $helper->analyzeAlarm();
    }
}
