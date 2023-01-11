<?php

namespace App\Utils;

use Illuminate\Support\Facades\Http;

trait HttpFormatter
{
    public function getHttpFormatter($url, $headers)
    {
        $data = Http::withHeaders(
            [
                'Authorization' =>  'Bearer 1|yZp3IIKeuZdfrSejkjBxEicChwp0l6aVvVNlUGkr',
                $headers
            ]
        )->accept('application/json')->get($url);
        return $data;
    }
}
