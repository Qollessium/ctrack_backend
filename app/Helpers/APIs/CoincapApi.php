<?php

namespace App\Helpers\API;

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

    public function coinList(bool $includePlatform = true){
        $connectUrl = 'v2/assets';

        if($includePlatform != null){ $params['include_platform'] = $includePlatform; }

        if($params != "" || $params != null){
            $queryString = http_build_query($params);
            $connectUrl = $connectUrl . '?' . $queryString;
        }

        $response = $this->connect($connectUrl)->json();

        $cryptos = [];
        foreach ($response as $item){
            $crypto = ([
                'name' => $item['name'],
                'symbol' => $item['symbol'],
                'coin_gecko_id' => $item['id']
            ]);

            $cryptos[] = $crypto;
        }

        return $cryptos;
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
