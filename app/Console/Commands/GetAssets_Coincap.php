<?php

namespace App\Console\Commands;

use App\Enums\CryptoCurrency\SourceEnum;
use App\Enums\CryptoCurrency\StatusEnum;
use App\Helpers\APIs\CoincapApi;
use App\Models\CryptoCurrency;
use Illuminate\Console\Command;

class GetAssets_Coincap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:get-assets_-coincap';

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

        do {
            $data = $api->coinList(null, null, $limit, $offset);

            foreach ($data['data'] as $cryptoData) {
                CryptoCurrency::updateOrCreate(
                    ['coincap_id' => $cryptoData['id']],
                    [
                        'coincap_id' => $cryptoData['id'],
                        'name' => $cryptoData['name'],
                        'description' => $cryptoData['id'],
                        'symbol' => $cryptoData['symbol'],
                        'status' => StatusEnum::ACTIVE,
                        'source' => SourceEnum::COINCAP,
                    ]
                );
            }

            $offset += $limit;
        } while (!empty($data['data']));

        $this->info('Cryptocurrencies saved successfully.');
    }
}
