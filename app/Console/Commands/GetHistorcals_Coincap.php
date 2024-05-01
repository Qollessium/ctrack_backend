<?php

namespace App\Console\Commands;

use App\Enums\CryptoCurrency\SourceEnum;
use App\Enums\CryptoCurrency\StatusEnum;
use App\Helpers\APIs\CoincapApi;
use App\Models\CryptoCurrency;
use App\Models\CryptoCurrencyHistorical;
use Carbon\Carbon;
use Illuminate\Console\Command;

class GetHistorcals_Coincap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:get-historcals_-coincap';

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
                $crypto_id = CryptoCurrency::where('coincap_id', $cryptoData['id'])->first()->id;
                $result = $this->saveHistoricalData($crypto_id, $cryptoData, $date);
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
