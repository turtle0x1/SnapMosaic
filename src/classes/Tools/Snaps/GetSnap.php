<?php

namespace dhope0000\SnapMosaic\Tools\Snaps;

use dhope0000\SnapMosaic\Tools\Hosts\GetHost;
use dhope0000\SnapMosaic\Tools\Utilities\StringTools;

class GetSnap
{
    private $getHost;

    public function __construct(GetHost $getHost)
    {
        $this->getHost = $getHost;
    }

    public function get(string $name)
    {
        $host = $this->getHost->get();

        $snap = $host->snaps->info($name)["result"];

        return $snap;
    }
}
