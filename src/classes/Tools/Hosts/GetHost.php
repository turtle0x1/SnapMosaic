<?php

namespace dhope0000\SnapMosaic\Tools\Hosts;

use dhope0000\Snap\Client;
use GuzzleHttp\Client as GuzzleClient;
use Http\Adapter\Guzzle6\Client as GuzzleAdapter;

class GetHost
{
    public function __construct()
    {
    }

    public function get()
    {
        $config = [
            "curl"=>[
                CURLOPT_UNIX_SOCKET_PATH => '/run/snapd.socket'
            ]
        ];

        $guzzle = new GuzzleClient($config);
        $adapter = new GuzzleAdapter($guzzle);
        return new Client("http://localhost", null, $adapter);
    }
}
