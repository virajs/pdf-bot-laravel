<?php

namespace Optimus\PdfBot;

use GuzzleHttp\Client;

class PdfBot
{
    private $config;

    public function __construct(array $config)
    {
        $this->config = $config;
    }

    public function push($url, array $meta = [])
    {
        $headers = [];

        if (!empty($this->config['api_token'])) {
            $headers['authorization'] = 'Bearer ' . $this->config['api_token'];
        }

        $client = new Client();
        return $client->request('POST', $this->config['server'], [
            'headers' => $headers,
            'json' => [
                'url' => $url,
                'meta' => (object) $meta
            ]
        ]);
    }
}
