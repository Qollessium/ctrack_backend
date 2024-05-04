<?php

namespace App\Console\Commands;

use App\Enums\CryptoCurrency\SourceEnum;
use App\Helpers\APIs\CoincapApi;
use App\Models\CryptoCurrency;
use App\Models\CryptoCurrencyHistorical;
use Carbon\Carbon;
use Illuminate\Console\Command;

class create_historical_m1 extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create_historical_m1';

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
        $api = new CoincapApi();
        $limit = 2000;
        $offset = 0;
        $date = Carbon::now()->startOfMinute();

        do {
            $data = $api->coinList(null, null, $limit, $offset);

            foreach ($data['data'] as $cryptoData) {
                $cryptoFromDB = CryptoCurrency::where('coincap_id', $cryptoData['id'])->first();

                $percentChange = null;
                if(!empty($cryptoFromDB->last_record_m1)) {
                    $last_record_m1 = $cryptoFromDB->lastRecordM1;
                    $oldPrice = $last_record_m1->price;
                    $newPrice = $cryptoData['priceUsd'];

                    if($oldPrice > 0 && $newPrice > 0) {
                        $priceChange = $newPrice - $oldPrice;
                        $percentChange = ($priceChange / $oldPrice) * 100;
                    }

                }

                $result = $this->saveHistoricalData($cryptoFromDB->id, $cryptoData, $date);
                $resultCryptoCurrency = $cryptoFromDB->update([
                    'last_record_m1' => $result->id,
                    'last_change_percent_m1' => $percentChange
                ]);
            }

            $offset += $limit;
        } while (!empty($data['data']));
    }

    /**
     * Save historical data for a crypto currency.
     *
     * @param int $cryptoCurrencyId
     * @param array $historicalData
     */
    private function saveHistoricalData($cryptoCurrencyId, $historicalData, $date)
    {
        $result = CryptoCurrencyHistorical::create([
            'crypto_currency_id' => $cryptoCurrencyId,
            'price' => $historicalData['priceUsd'] ?? 0,
            'interval' => 'm1',
            'date' => $date,
            'source' => SourceEnum::COINCAP,
        ]);

        return $result;
    }
}
