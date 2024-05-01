<?php

namespace App\Helpers\APIs;

use Illuminate\Support\Facades\Http;

class CoincapApi
{
    const URL = "api.coincap.io/";

    protected function connect(string $url)
    {
        return Http::baseUrl(self::URL)
            ->withHeaders([
                "Accept" => "application/json",
                // "x-cg-pro-api-key" => "",
            ])
            ->get($url);
    }

    protected function getAuthentication(): array
    {
        return [];
    }

    public function coinList($search = null, $ids = null, $limit = 100, $offset = 0){
        $connectUrl = 'v2/assets';

        $params = [
            'limit' => $limit,
            'offset' => $offset
        ];

        if ($search !== null) {
            $params['search'] = $search;
        }

        if ($ids !== null) {
            $params['ids'] = $ids;
        }

        $query_string = http_build_query($params);
        $connectUrl = $connectUrl . '?' . $query_string;

        $response = $this->connect($connectUrl)->json();
        return $response;
    }

    public function coinHistory($exchangeId = null, $baseSymbol = null, $quoteSymbol = null, $baseId = null, $quoteId = null, $assetSymbol = null, $assetId = null, $limit = 100, $offset = 0){
        $connectUrl = 'v2/markets';

        $params = [
            'limit' => $limit,
            'offset' => $offset
        ];

        if ($exchangeId !== null) {
            $params['exchangeId'] = $exchangeId;
        }

        if ($baseSymbol !== null) {
            $params['baseSymbol'] = $baseSymbol;
        }

        if ($quoteSymbol !== null) {
            $params['quoteSymbol'] = $quoteSymbol;
        }

        if ($baseId !== null) {
            $params['baseId'] = $baseId;
        }

        if ($quoteId !== null) {
            $params['quoteId'] = $quoteId;
        }

        if ($assetSymbol !== null) {
            $params['assetSymbol'] = $assetSymbol;
        }

        if ($assetId !== null) {
            $params['assetId'] = $assetId;
        }


        $query_string = http_build_query($params);
        $connectUrl = $connectUrl . '?' . $query_string;

        $response = $this->connect($connectUrl)->json();
        return $response;
    }




    public function coinMarkets(string $vsCurrency, string $ids, int $perPage = 250){
        $connectUrl = '/v3/coins/markets';

        if($vsCurrency != null){ $params['vs_currency'] = $vsCurrency; }
        if($ids != null){ $params['ids'] = $ids; }
        if($perPage != null){ $params['per_page'] = $perPage; }

        if($params != "" || $params != null){
            $query_string = http_build_query($params);
            $connectUrl = $connectUrl . '?' . $query_string;
        }

        $response = $this->connect($connectUrl)->json();

        $historicals = [];
        foreach ($response as $item){
            $historical = ([
                'coin_gecko_id' => $item['id'],
                'name' => $item['name'],
                'symbol' => $item['symbol'],
                'price' => $item['current_price'],
                'last_updated' => $item['last_updated']
            ]);

            $historicals[] = $historical;
        }

        return $historicals;
    }
}
