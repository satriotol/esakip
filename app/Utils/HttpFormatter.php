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
    public function apiGetPenyerapanHttp($url, $parameter)
    {
        $data = Http::withHeaders([
            'X-API-KEY' =>  'b6fbfd30e219172b63a75579fd0a798229d019518bb47d01c6e23d8a0376b043',
        ])->get($url, $parameter);
        return $data;
    }
}
