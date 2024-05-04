<?php

namespace App\Console\Commands;

use App\Models\CryptoCurrency;
use Illuminate\Console\Command;

class create_historical_h4 extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create_historical_h4';

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
        $allCryptoCurrencies = CryptoCurrency::all();

        foreach ($allCryptoCurrencies as $cryptoCurrency) {

            $percentChange = null;
            if(!empty($cryptoCurrency->last_record_h4)) {
                $last_record_h4 = $cryptoCurrency->last_record_h4;
                $oldPrice = $last_record_h4->price;
                $newPrice = $cryptoCurrency->price;

                if($oldPrice > 0 && $newPrice > 0) {
                    $priceChange = $newPrice - $oldPrice;
                    $percentChange = ($priceChange / $oldPrice) * 100;
                }
            }

            if(!empty($cryptoCurrency['last_record_m1'])) {
                $cryptoCurrency->update([
                    'last_record_h4' => $cryptoCurrency['last_record_m1'],
                    'last_change_percent_h4' => $percentChange
                ]);
            }
        }

    }
}
