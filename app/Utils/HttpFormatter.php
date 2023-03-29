<?php

namespace App\Utils;

use Illuminate\Support\Facades\Http;

trait HttpFormatter
{
    public function getHttpFormatter($url, $headers)
    {
        $data = Http::withHeaders(
            [
                'Authorization' =>  'Bearer 1|bgIF18VQIg7RxEAZgr8StPBVYQOJAS6J3K2ccA7v',
                $headers
            ]
        )->accept('application/json')->get($url);
        return $data;
    }
    public function apiGetHttp($url, $parameter)
    {
        $data = Http::withHeaders([
            'Authorization' =>  'Bearer 1|bgIF18VQIg7RxEAZgr8StPBVYQOJAS6J3K2ccA7v',
        ])->get($url, $parameter);
        return $data;
    }
}
