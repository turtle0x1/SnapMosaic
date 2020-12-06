<?php

namespace dhope0000\SnapMosaic\Controllers\Snaps;

use \dhope0000\SnapMosaic\Tools\Snaps\GetSnap;

class GetSnapController
{
    private $getSnap;

    public function __construct(GetSnap  $getSnap)
    {
        $this->getSnap = $getSnap;
    }

    public function get(string $name)
    {
        return $this->getSnap->get($name);
    }
}
